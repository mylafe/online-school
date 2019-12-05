<?php
namespace app\components;

use Yii;
use yii\helpers\FileHelper;

class Util
{
    // 格式化时间
    public static function format_time($gmt)
    {
        $second = time() - $gmt;

        if ($second <= 60) {
            return '刚刚';
        }

        if ($second <= 3600) {
            return floor($second / 60) . ' 分钟前';
        }

        if ($second <= 3600 * 24) {
            return floor($second / 3600) . ' 小时前';
        }

        if (date("Y", $gmt) == date("Y", time())) {
            return date("m-d H:i", $gmt);
        }

        return date("Y-m-d", $gmt);
    }

    // 随机数字
    public static function random_number($len, $type = 'numeric')
    {
        switch ($type)
        {
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
        }
        return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
    }
}
