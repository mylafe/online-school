<?php

namespace app\models\member;

use Yii;
/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $uuid         唯一编号
 * @property string $name         名称
 * @property string $phone        手机号
 * @property string $gmt_create   记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class User extends \yii\db\ActiveRecord
{

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        return $scenarios;
    }

    public function rules()
    {
        return [];
    }

    public static function tableName()
    {
        return '{{user}}';
    }

    public static function getDb()
    {
        return Yii::$app->get('db');
    }

}