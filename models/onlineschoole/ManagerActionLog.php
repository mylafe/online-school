<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "manager_action_log".
 *
 * @property string $id
 * @property string $username 登陆名
 * @property string $action 用户行为
 * @property string $method 方法
 * @property string $model 模块
 * @property string $params url参数
 * @property string $detail 操作详情
 * @property string $from_ip 操作人ip
 * @property string $gmt_create 创建时间
 */
class ManagerActionLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manager_action_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gmt_create'], 'safe'],
            [['username'], 'string', 'max' => 32],
            [['action', 'method', 'model', 'params', 'detail'], 'string', 'max' => 256],
            [['from_ip'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'action' => 'Action',
            'method' => 'Method',
            'model' => 'Model',
            'params' => 'Params',
            'detail' => 'Detail',
            'from_ip' => 'From Ip',
            'gmt_create' => 'Gmt Create',
        ];
    }
}
