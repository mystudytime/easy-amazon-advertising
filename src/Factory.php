<?php

namespace easyAmazonAdv;

/**
 * Class Factory.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2019-11-12 15:04
 */
class Factory
{
    /**
     * make.
     *
     * @param $name
     * @param array $config
     *
     * @return mixed
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:04
     */
    public static function make($name, array $config)
    {
        switch ($name) {
            case 'SBrands':
                $name = 'SponsoredBrands';

                break;
            case 'SDisplay':
                $name = 'SponsoredDisplay';

                break;
            case 'SProducts':
                $name = 'SponsoredProducts';

                break;
            default:
        }
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\easyAmazonAdv\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * __callStatic.
     *
     * @param $name
     * @param $arguments
     *
     * @return mixed
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-12 15:04
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
