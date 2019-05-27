<?php

namespace app\modules\member\controllers\home;

use yii\base\Action;

use Yii;

class ListAction extends Action
{

    public function run()
    {
        $type = Yii::$app->request->post('type');//Yii::$app->request->getBodyParam('type');
//        $raw_data = Yii::$app->request->rawBody;
//        var_dump($raw_data);
        $data = [
            'type' => $type,
            'demo' => 'demo'
        ];

        return $this->controller->response(200, $data);
    }
}
