<?php
namespace app\components;

use yii\base\Behavior;
use yii\base\Controller;

use Yii;
use yii\helpers\Json;
use yii\web\Response;

class SignBehavior extends Behavior
{

    private $secret = 'WYck94OIDWKJDUudjwdmdw93memBER';

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    public function beforeAction($event)
    {

        $raw_data = Yii::$app->request->rawBody;
        $data = Json::decode($raw_data);

        $is_signed = false;
        if (! isset($data['timestamp']) || $data['timestamp'] == '' ||
            ! isset($data['sign']) || $data['sign'] == '' ||
            ! isset($data['nonce']) || $data['nonce'] == ''
        ) {
            $is_signed = FALSE;
        } else {

            $sign = $data['sign'];

            unset($data['sign']);

            ksort($data);

            //        $str      = urldecode(http_build_query($data));

            $str = '';

            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    continue;
                }

                $str = $str . $key . '=' . $value . '&';
            }

            $str = urldecode(substr($str, 0, -1));

            $strTemp  = $str . "&secret=" . $this->secret;

            $signTemp = strtoupper(md5($strTemp));


            if ($sign == $signTemp) {
                $is_signed = true;
            }
        }

        if(!$is_signed) {
            $json = [
                'code' => 201,
                'note' => '验签错误',
                'data' => (Object)[]
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            echo Json::encode($json); Yii::$app->end();
        }

        return true;
    }

}
