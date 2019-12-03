<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $uuid 身份唯一标识
 * @property string $username 登陆名
 * @property string $nickname 昵称
 * @property string $phone 手机号
 * @property string $password 密码
 * @property string $avatar 头像的地址
 * @property int $is_delete 是否删除：0 否，1 是
 * @property string $delete_time 删除时间
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 更新时间
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_delete', 'delete_time'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['uuid'], 'string', 'max' => 32],
            [['username', 'nickname'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 11],
            [['password', 'avatar'], 'string', 'max' => 255],
            [['uuid'], 'unique'],
            [['username'], 'unique'],
            [['phone'], 'unique'],
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
            'username' => 'Username',
            'nickname' => 'Nickname',
            'phone' => 'Phone',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'is_delete' => 'Is Delete',
            'delete_time' => 'Delete Time',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
