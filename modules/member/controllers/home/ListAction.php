<?php

namespace app\modules\member\controllers\home;

use yii\base\Action;
use app\models\member\User;

use Yii;

class ListAction extends Action
{

    public function run()
    {
        //创建事务
        $tr = Yii::$app->db->beginTransaction();

        try {

            // 插入三条数据
            for($i=1;$i<=3;$i++){

                $test = new User();
                $test->uuid = md5(uniqid(mt_rand(), true));
                $test->name = 'name'.$i;
                $test->phone=str_repeat($i,11);
                if($test->save()){
                    echo "save $i | ";
                }

            }

            // 异常数据
            $test = new User();
            $test->uuid = md5(uniqid(mt_rand(), true));
            $test->name = 'no'.$i;
            $test->phone="0000000000";
            $test->sorta= 1; // 写入不存在的字段
            if(!$test->save()){
                //throw new \yii\db\Exception(); // 手动抛出异常,再由下面捕获
                "save fail"; // 如果没有写入就输出
            }

            //提交事务
            $tr->commit();

        } catch (\Exception $e) {
            //回滚
            $tr->rollBack();
            echo  "rollback";
        }

    }

}
