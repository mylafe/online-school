<?php

namespace app\components;
use yii\web\Controller;

class BaseController extends Controller
{

    public static $notes = [
        '200' => '请求成功',
        '201' => '请求数据错误',
        '204' => '请求参数错误'
    ];

    public function response($code, $data, $note='') {
        $note = $note ? $note : (isset(self::$notes[$code])?self::$notes[$code]:'');
        return $this->asJson(["code" => $code,"note" => $note,"data"=> $data]);
    }

}
