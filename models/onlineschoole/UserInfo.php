<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property string $id
 * @property string $uuid 身份唯一标识
 * @property string $email 邮箱地址
 * @property int $sex 性别：0 未知 1 男 2 女
 * @property string $born 出生日期
 * @property int $height 身高，单位 cm
 * @property string $weight 体重，单位 kg
 * @property string $remark 备注
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 更新时间
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sex', 'born', 'height'], 'integer'],
            [['weight'], 'number'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['uuid'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 128],
            [['remark'], 'string', 'max' => 512],
            [['uuid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'email' => 'Email',
            'sex' => 'Sex',
            'born' => 'Born',
            'height' => 'Height',
            'weight' => 'Weight',
            'remark' => 'Remark',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
