<?php
namespace app\components;

use yii\base\Behavior;
use yii\base\Controller;
use Yii;
use yii\web\Response;
use yii\helpers\Json;

class TokenBehavior extends Behavior
{

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    public $explodeRoute = [// 免登陆配置
        '/v1/home/list',
    ];

    public function beforeAction($event)
    {
        $raw_data = Yii::$app->request->rawBody;
        $data = Json::decode($raw_data);
        $temp_url = explode('?',Yii::$app->request->url)[0];

        if (! isset($data['token'])
            && !(in_array($temp_url, $this->explodeRoute))
        ) {
            $json = [
                'code' => 201,
                'note' => '限制资源，请先登录.',
                'data' => (Object)[]
            ];

            Yii::$app->response->format = Response::FORMAT_JSON;
            echo Json::encode($json); Yii::$app->end();
        }

        Yii::$app->request->setBodyParams($data); // 原生请求体

        return true;
    }

}
