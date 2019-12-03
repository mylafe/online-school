<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "manager".
 *
 * @property string $id
 * @property string $auid 身份标识符
 * @property string $username 登陆名
 * @property string $nickname 昵称
 * @property string $phone 手机号
 * @property string $email 邮箱
 * @property string $password 密码
 * @property string $avatar 头像的地址
 * @property int $status 状态0 停用 1 正常
 * @property int $is_delete 是否删除：0 否，1 是
 * @property string $delete_time 删除时间
 * @property string $remark 备注
 * @property string $gmt_create 记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class Manager extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'is_delete', 'delete_time'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['auid', 'username', 'nickname'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 255],
            [['avatar', 'remark'], 'string', 'max' => 256],
            [['auid'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auid' => 'Auid',
            'username' => 'Username',
            'nickname' => 'Nickname',
            'phone' => 'Phone',
            'email' => 'Email',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'status' => 'Status',
            'is_delete' => 'Is Delete',
            'delete_time' => 'Delete Time',
            'remark' => 'Remark',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
