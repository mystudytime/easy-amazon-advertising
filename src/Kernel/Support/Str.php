<?php

namespace easyAmazonAdv\Kernel\Support;

/**
 * Class Str.
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2019-11-16 22:27
 */
class Str
{
    /** @var array */
    protected static $studlyCache = [];

    public static function studly($value)
    {
        $key = $value;

        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }

        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return static::$studlyCache[$key] = str_replace(' ', '', $value);
    }
}
