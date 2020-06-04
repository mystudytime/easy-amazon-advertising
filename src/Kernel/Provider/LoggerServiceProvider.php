<?php

namespace easyAmazonAdv\Kernel\Provider;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class LoggerServiceProvider.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2020-02-05 16:07
 */
class LoggerServiceProvider implements ServiceProviderInterface
{
    /**
     * register.
     *
     * @param Container $pimple
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-10 14:29
     */
    public function register(Container $pimple)
    {
        isset($pimple['logger']) || $pimple['logger'] = function ($app) {
            $config = $this->formatLogConfig($app);
            $logger = new Logger($config['channel']);
            $stream = new StreamHandler($config['path'], Logger::DEBUG);
            $formatter = new LineFormatter(null, null, true, true);
            $stream->setFormatter($formatter);
            $logger->pushHandler($stream);
            $logger->pushHandler(new FirePHPHandler());

            return $logger;
        };
    }

    /**
     * formatLogConfig 格式化日志.
     *
     * @param $app
     *
     * @return array
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2020-02-10 14:29
     */
    public function formatLogConfig($app)
    {
        $config = $app['config']->toArray();

        return [
            'channel' => 'EasyAmazonAdv',
            'path' => isset($config['log']['path']) ? $config['log']['path'] : \sys_get_temp_dir().'/logs/amazon/amazon_adv.log',
            'level' => isset($config['log']['level']) ? $config['log']['level'] : 'debug',
            'type' => isset($config['log']['type']) ? $config['log']['type'] : 'write',
        ];
    }
}
