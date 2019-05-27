<?php

namespace app\modules\member\controllers;

use app\components\BaseController;
use yii\filters\VerbFilter;


class HomeController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get','post'],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'list' => 'app\modules\member\controllers\home\ListAction', //首页列表
        ];

    }

}
