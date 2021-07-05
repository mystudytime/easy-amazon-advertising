<?php

namespace easyAmazonAdv\Kernel;

use easyAmazonAdv\Kernel\Exceptions\InvalidArgumentException;
use easyAmazonAdv\Kernel\Exceptions\InvalidConfigException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class BaseClient
{
    protected $app;

    protected $client;

    protected static $apiEndpoints = [
        'NA' => 'https://advertising-api.amazon.com',
        'EU' => 'https://advertising-api-eu.amazon.com',
        'FE' => 'https://advertising-api-fe.amazon.com',
    ];

    protected static $apiAuths = [
        'NA' => 'https://www.amazon.com/ap/oa',
        'EU' => 'https://eu.account.amazon.com/ap/oa',
        'FE' => 'https://apac.account.amazon.com/ap/oa',
    ];

    protected static $apiTokenUrls = [
        'NA' => 'https://api.amazon.com/auth/o2/token',
        'EU' => 'https://api.amazon.co.uk/auth/o2/token',
        // todo 不知什么原因此api无法调用，改用美国通用的实验
//        'FE' => 'https://api.amazon.co.jp/auth/o2/token',
    ];

    const MAX_RETRIES = 3;

    public $config;

    protected static $apiVersion = 'v2';

    public $apiEndpoint;

    public $apiNoVersionEndpoint;

    protected static $apiTokenUrl = 'https://api.amazon.com/auth/o2/token';

    public $apiAuth;

    public $profileId;

    public $requestId;

    /**
     * BaseClient constructor.
     *
     * @param $app
     *
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     */
    public function __construct($app)
    {
        $this->getClient();
        $this->app = $app;
        $this->requestId = time().'-'.rand();
        $this->config = $app['config']->toArray();
        $this->validateConfigParameters($this->config);
        $this->setEndpoint($this->config['region']);
        if (isset($app['client']->profileId) && !empty($app['client']->profileId)) {
            $this->profileId = $app['client']->profileId;
        }
        if (empty($this->config['accessToken']) && !empty($this->config['refreshToken'])) {
            $this->doRefreshToken();
        }
    }

    /**
     * getClient.
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020/4/28 18:00
     */
    public function getClient()
    {
        // 创建 Handler
        $handlerStack = HandlerStack::create(new CurlHandler());
        // 创建重试中间件，指定决策者为 $this->retryDecider(),指定重试延迟为 $this->retryDelay()
        $handlerStack->push(Middleware::retry($this->retryDecider(), $this->retryDelay()));
        // 指定 handler
        $this->client = new Client(['handler' => $handlerStack]);
    }

    /**
     * validateConfigParameters.
     *
     * @param $config
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-10 22:19
     */
    public function validateConfigParameters(array $config)
    {
        if (is_null($config)) {
            throw new InvalidArgumentException('The configuration parameter is null');
        }
        if (empty($config['clientId']) || !preg_match("/^amzn1\.application-oa2-client\.[a-z0-9]{32}$/i", $config['clientId'])) {
            throw new InvalidConfigException('Invalid parameter value for clientId.');
        }
        if (empty($config['clientSecret']) || !preg_match('/^[a-z0-9]{64}$/i', $config['clientSecret'])) {
            throw new InvalidConfigException('Invalid parameter value for clientSecret.');
        }
        if (empty($config['region']) || !in_array($config['region'], array_keys(self::$apiEndpoints))) {
            throw new InvalidConfigException('Invalid parameter value for region.');
        }

        if (!isset($config['grant_type'])) {
            if (empty($config['accessToken']) && empty($config['refreshToken'])) {
                throw new InvalidConfigException('Missing required parameter accessToken or refreshToken');
            }
            if (!empty($config['accessToken']) && !preg_match("/^Atza(\||%7C|%7c).*$/", $config['accessToken'])) {
                throw new InvalidConfigException('Invalid parameter value for accessToken.');
            }
            if (!empty($config['refreshToken']) && !preg_match("/^Atzr(\||%7C|%7c).*$/", $config['refreshToken'])) {
                throw new InvalidConfigException('Invalid parameter value for refreshToken.');
            }
        } else {
            if (empty($config['redirect_uri'])) {
                throw new InvalidConfigException('Missing required parameter redirect_uri');
            }
            if ('authorization_code' == $config['grant_type'] && empty($config['code'])) {
                throw new InvalidConfigException('Missing required parameter code');
            }
        }

        return true;
    }

    public function setEndpoint(string $region)
    {
        $this->apiEndpoint = isset(self::$apiEndpoints[$region]) ? self::$apiEndpoints[$region].'/'.self::$apiVersion : '';
        $this->apiNoVersionEndpoint = isset(self::$apiEndpoints[$region]) ? self::$apiEndpoints[$region] : '';
        $this->apiAuth = isset(self::$apiAuths[$region]) ? self::$apiAuths[$region] : '';
        self::$apiTokenUrl = isset(self::$apiTokenUrls[$region]) ? self::$apiTokenUrls[$region] : self::$apiTokenUrl;
    }

    /**
     * doRefreshToken.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 00:24
     */
    public function doRefreshToken()
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'User-Agent' => 'AdvertisingAPI PHP Client Library v1.2',
        ];
        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->config['refreshToken'],
            'client_id' => $this->config['clientId'],
            'client_secret' => $this->config['clientSecret'],
        ];

        return $this->request(self::$apiTokenUrl, 'POST', ['form_params' => $params, 'headers' => $headers, 'timeout' => 30]);
    }

    /**
     * getOAuthUrl.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-06-04 00:24
     */
    public function getOAuthUrl()
    {
        $params = [
            'client_id' => $this->config['clientId'],
            'response_type' => 'code',
            'scope' => 'cpc_advertising:campaign_management',
            'redirect_uri' => $this->config['redirect_uri'],
            'state' => isset($this->config['state']) ? $this->config['state'] : '',
        ];

        return [
            'success' => true,
            'code' => 200,
            'response' => !empty($this->apiAuth) ? $this->apiAuth.'?'.http_build_query($params) : '',
            'requestId' => !empty($requestId) ? $requestId : 0,
        ];
    }

    /**
     * 授权获取亚马逊token.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-06-04 00:24
     */
    public function OAuth()
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'charset' => 'UTF-8',
        ];
        $params = [
            'grant_type' => 'authorization_code',
            'code' => $this->config['code'],
            'redirect_uri' => $this->config['redirect_uri'],
            'client_id' => $this->config['clientId'],
            'client_secret' => $this->config['clientSecret'],
        ];

        return $this->request(self::$apiTokenUrl, 'POST', ['form_params' => $params, 'headers' => $headers, 'timeout' => 30]);
    }

    /**
     * request.
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:49
     */
    public function request(string $url, string $requestType, array $options)
    {
        try {
            $this->sendWriteLog($this->requestId, $requestType, $url, $options, []);
            $response = $this->client->request($requestType, $url, $options);
            $httpCode = $response->getStatusCode();
            $message = \GuzzleHttp\json_decode($response->getBody(), true);
            if (!empty($response->getHeader('x-amz-request-id'))) {
                $requestId = $response->getHeader('x-amz-request-id')[0];
            }
        } catch (Exception $exception) {
            $httpCode = $exception->getCode();
            $message = $exception->getMessage();
        }
        $this->sendWriteLog($this->requestId, $requestType, $url, [], $message);

        return [
            'success' => !empty($httpCode) && preg_match("/^(2|3)\d{2}$/", $httpCode) ? true : false,
            'code' => $httpCode,
            'response' => $message,
            'requestId' => !empty($requestId) ? $requestId : 0,
        ];
    }

    /**
     * httpGet.
     *
     * @param bool $isVersion
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-20 10:53
     */
    public function httpGet(string $url, array $data = [], $isVersion = true)
    {
        $headers = [
            'Authorization' => 'bearer '.$this->config['accessToken'],
            'Content-Type' => 'application/json',
            'Amazon-Advertising-API-ClientId' => $this->config['clientId'],
        ];
        if (!empty($this->profileId)) {
            $headers['Amazon-Advertising-API-Scope'] = $this->profileId;
        }

        $requestUrl = $isVersion ? $this->apiEndpoint : $this->apiNoVersionEndpoint;

        return $this->request($requestUrl.$url, 'GET', ['query' => $data, 'headers' => $headers, 'timeout' => 30]);
    }

    /**
     * httpPost.
     *
     * @param bool $isVersion
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-20 10:53
     */
    public function httpPost(string $url, array $data = [], array $query = [], $isVersion = true)
    {
        $headers = [
            'Authorization' => 'bearer '.$this->config['accessToken'],
            'Content-Type' => 'application/json',
            'Amazon-Advertising-API-ClientId' => $this->config['clientId'],
        ];
        if (!empty($this->profileId)) {
            $headers['Amazon-Advertising-API-Scope'] = $this->profileId;
        }

        $requestUrl = $isVersion ? $this->apiEndpoint : $this->apiNoVersionEndpoint;

        return $this->request($requestUrl.$url, 'POST', ['query' => $query, 'json' => $data, 'headers' => $headers, 'timeout' => 30]);
    }

    /**
     * httpPut.
     *
     * @param bool $isVersion
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-20 10:54
     */
    public function httpPut(string $url, array $data = [], array $query = [], $isVersion = true)
    {
        $headers = [
            'Authorization' => 'bearer '.$this->config['accessToken'],
            'Content-Type' => 'application/json',
            'Amazon-Advertising-API-ClientId' => $this->config['clientId'],
        ];
        if (!empty($this->profileId)) {
            $headers['Amazon-Advertising-API-Scope'] = $this->profileId;
        }

        $requestUrl = $isVersion ? $this->apiEndpoint : $this->apiNoVersionEndpoint;

        return $this->request($requestUrl.$url, 'PUT', ['query' => $query, 'json' => $data, 'headers' => $headers, 'timeout' => 30]);
    }

    /**
     * httpDelete.
     *
     * @param bool $isVersion
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-20 10:54
     */
    public function httpDelete(string $url, array $data = [], array $query = [], $isVersion = true)
    {
        $headers = [
            'Authorization' => 'bearer '.$this->config['accessToken'],
            'Content-Type' => 'application/json',
            'Amazon-Advertising-API-ClientId' => $this->config['clientId'],
        ];
        if (!empty($this->profileId)) {
            $headers['Amazon-Advertising-API-Scope'] = $this->profileId;
        }
        $requestUrl = $isVersion ? $this->apiEndpoint : $this->apiNoVersionEndpoint;

        return $this->request($requestUrl.$url, 'DELETE', ['query' => $query, 'json' => $data, 'headers' => $headers, 'timeout' => 30]);
    }

    /**
     * httpDownload.
     *
     * @param bool $isVersion
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-20 10:55
     */
    public function httpDownload(string $url, array $data = [], $isVersion = true)
    {
        $headers = [
            'Authorization' => 'bearer '.$this->config['accessToken'],
            'Content-Type' => 'application/json',
            'Amazon-Advertising-API-ClientId' => $this->config['clientId'],
        ];
        if (!empty($this->profileId)) {
            $headers['Amazon-Advertising-API-Scope'] = $this->profileId;
        }

        $path_file = $data['path'].'/report/'.date('Y').'/'.date('m').'/'.date('d').'/';
        if (!is_dir($path_file)) {
            mkdir($path_file, 0755, true);
        }
        $temp_file = $path_file.$data['reportId'].'.gz';

        $requestUrl = $isVersion ? $this->apiEndpoint : $this->apiNoVersionEndpoint;
        $response = $this->client->get($requestUrl.$url, ['headers' => $headers, 'query' => [], 'save_to' => $temp_file, 'timeout' => 120]);

        if (200 == $response->getStatusCode() && !empty(($report = $this->read_gz($temp_file)))) {
            $report = \GuzzleHttp\json_decode($report, true);
        }

        unlink($temp_file);

        return [
            'success' => 200 == $response->getStatusCode() ? true : false,
            'code' => $response->getStatusCode(),
            'response' => !empty($report) ? $report : [],
        ];
    }

    /**
     * read_gz 读取压缩文件.
     *
     * @param $gz_file
     *
     * @return string
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-10 14:35
     */
    public function read_gz($gz_file, int $buffer_size = 4096)
    {
        $file = gzopen($gz_file, 'rb');
        $content = '';
        while (!gzeof($file)) {
            $content .= gzread($file, $buffer_size);
        }
        gzclose($file);

        return $content;
    }

    /**
     * sendWriteLog.
     *
     * @param array $options
     * @param array $message
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-06 11:18
     */
    public function sendWriteLog(string $requestId, string $requestType, string $url, $options = [], $message = [])
    {
        if (isset($this->config['log']) && !empty($this->config['log'])) {
            if (isset($this->config['log']['type'])) {
                switch ($this->config['log']['type']) {
                    case 'read':
                        if ('GET' == $requestType) {
                            $this->writeLog($requestId, $requestType, $url, $options, $message);
                        }

                        break;
                    case 'write':
                        if (in_array($requestType, ['PUT', 'POST', 'DELETE'])) {
                            $this->writeLog($requestId, $requestType, $url, $options, $message);
                        }

                        break;
                    case 'all':
                        $this->writeLog($requestId, $requestType, $url, $options, $message);

                        break;
                }
            }
        }
    }

    /**
     * writeLog.
     *
     * @param array $options
     * @param array $message
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-06 11:18
     */
    public function writeLog(string $requestId, string $requestType, string $url, $options = [], $message = [])
    {
        $this->app['logger']->info('message:', [
            'time' => date('Y-m-d  H:i:s'),
            'requestId' => $requestId,
            'method' => $requestType,
            'uri' => $url,
            'request' => $options,
            'response' => $message,
        ]);
    }

    /**
     * 返回一个匿名函数，该匿名函数返回下次重试的时间（毫秒）.
     *
     * @return \Closure
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-06-09 17:40
     */
    protected function retryDelay()
    {
        return function ($numberOfRetries) {
            return 2000 * $numberOfRetries;
        };
    }

    /**
     * 返回一个匿名函数，判定是否重试.
     *
     * @return \Closure
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-06-09 17:40
     */
    protected function retryDecider()
    {
        return function ($retries, Request $request, Response $response = null, RequestException $exception = null) {
            if ($retries >= self::MAX_RETRIES) {
                return false;
            }

            if ($retries > 0) {
                try {
                    $param = [
                        'path' => $request->getUri()->getPath(),
                        'param' => \GuzzleHttp\json_decode($request->getBody(), true),
                        'result' => \GuzzleHttp\json_decode($response->getBody(), true),
                    ];
                } catch (Exception $exception) {
                    $param = [];
                }
                $message = 'start retry time is '.$retries.' info: ';
                $this->app['logger']->info($message, $param);
            }

            if ($exception instanceof ConnectException) {
                return true;
            }
            if ($response) {
                $status = $response->getStatusCode();
                if ($status >= 500 || 429 == $status) {
                    return true;
                }
            }

            return false;
        };
    }
}
