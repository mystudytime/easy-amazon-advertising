<?php

namespace easyAmazonAdv\Kernel;

use easyAmazonAdv\Kernel\Exceptions\InvalidArgumentException;
use easyAmazonAdv\Kernel\Exceptions\InvalidConfigException;
use GuzzleHttp\Client;
use Exception;

class BaseClient
{
    protected $app;

    protected $client;

    protected static $apiEndpoints = [
        'NA' => 'https://advertising-api.amazon.com',
        'EU' => 'https://advertising-api-eu.amazon.com',
        'FE' => 'https://advertising-api-fe.amazon.com',
    ];

    public $config;

    protected static $apiVersion = 'v2';

    protected static $apiTokenUrl = 'https://api.amazon.com/auth/o2/token';

    public $apiEndpoint;

    public $apiNoVersionEndpoint;

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
        $this->app = $app;
        $this->requestId = time().'-'.rand();
        $this->config = $app['config']->toArray();
        $this->setEndpoint($this->config['region']);
        $this->validateConfigParameters($this->config);
        if (isset($app['client']->profileId) && !empty($app['client']->profileId)) {
            $this->profileId = $app['client']->profileId;
        }
        if (empty($this->config['accessToken']) && !empty($this->config['refreshToken'])) {
            $this->doRefreshToken();
        }
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
        if (empty($config['accessToken']) && empty($config['refreshToken'])) {
            throw new InvalidConfigException('Missing required parameter accessToken or refreshToken');
        }
        if (empty($config['clientId']) || !preg_match("/^amzn1\.application-oa2-client\.[a-z0-9]{32}$/i", $config['clientId'])) {
            throw new InvalidConfigException('Invalid parameter value for clientId.');
        }
        if (empty($config['region']) || !in_array($config['region'], array_keys(self::$apiEndpoints))) {
            throw new InvalidConfigException('Invalid parameter value for region.');
        }
        if (empty($config['clientSecret']) || !preg_match('/^[a-z0-9]{64}$/i', $config['clientSecret'])) {
            throw new InvalidConfigException('Invalid parameter value for clientSecret.');
        }
        if (!empty($config['accessToken']) && !preg_match("/^Atza(\||%7C|%7c).*$/", $config['accessToken'])) {
            throw new InvalidConfigException('Invalid parameter value for accessToken.');
        }
        if (!empty($config['refreshToken']) && !preg_match("/^Atzr(\||%7C|%7c).*$/", $config['refreshToken'])) {
            throw new InvalidConfigException('Invalid parameter value for refreshToken.');
        }

        return true;
    }

    public function setEndpoint(string $region)
    {
        $this->apiEndpoint = self::$apiEndpoints[$region].'/'.self::$apiVersion;
        $this->apiNoVersionEndpoint = self::$apiEndpoints[$region];
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

        return $this->request(self::$apiTokenUrl, 'POST', ['form_params' => $params, 'headers' => $headers]);
    }

    /**
     * request.
     *
     * @param string $url
     * @param string $requestType
     * @param array  $options
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-14 19:49
     */
    public function request(string $url, string $requestType, array $options)
    {
        $client = new Client();

        try {
            $this->sendWriteLog($this->requestId, $requestType, $url, $options, []);
            $response = $client->request($requestType, $url, $options);
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
     * @param string $url
     * @param array  $data
     * @param bool   $isVersion
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

        return $this->request($requestUrl.$url, 'GET', ['query' => $data, 'headers' => $headers]);
    }

    /**
     * httpPost.
     *
     * @param string $url
     * @param array  $data
     * @param array  $query
     * @param bool   $isVersion
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

        return $this->request($requestUrl.$url, 'POST', ['query' => $query, 'json' => $data, 'headers' => $headers]);
    }

    /**
     * httpPut.
     *
     * @param string $url
     * @param array  $data
     * @param array  $query
     * @param bool   $isVersion
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

        return $this->request($requestUrl.$url, 'PUT', ['query' => $query, 'json' => $data, 'headers' => $headers]);
    }

    /**
     * httpDelete.
     *
     * @param string $url
     * @param array  $data
     * @param array  $query
     * @param bool   $isVersion
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

        return $this->request($requestUrl.$url, 'DELETE', ['query' => $query, 'json' => $data, 'headers' => $headers]);
    }

    /**
     * httpDownload.
     *
     * @param string $url
     * @param array  $data
     * @param bool   $isVersion
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

        $client = new Client();
        $requestUrl = $isVersion ? $this->apiEndpoint : $this->apiNoVersionEndpoint;
        $response = $client->get($requestUrl.$url, ['headers' => $headers, 'query' => [], 'save_to' => $temp_file]);

        if (200 == $response->getStatusCode() && !empty(($report = $this->read_gz($temp_file)))) {
            $report = \GuzzleHttp\json_decode($report, true);
        } else {
            unlink($temp_file);
        }

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
     * @param int $buffer_size
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
     * @param string $requestId
     * @param string $requestType
     * @param string $url
     * @param array  $options
     * @param array  $message
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
     * @param string $requestId
     * @param string $requestType
     * @param string $url
     * @param array  $options
     * @param array  $message
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
}
