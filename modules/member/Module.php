<?php

namespace app\modules\member;

use app\components\SignBehavior;
use app\components\TokenBehavior;

/**
 * member module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\member\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        //$this->attachBehavior('sign', ['class' => SignBehavior::className()]);// 验签
        $this->attachBehavior('token', ['class' => TokenBehavior::className()]);// json数据处理

        // 解决接口跨域问题
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers:x-requested-with,content-type, REQUESTAPP,REQUESTCLIENT,VERSIONFORAPP');
    }
}
