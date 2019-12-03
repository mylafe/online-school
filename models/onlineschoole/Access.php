<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "access".
 *
 * @property string $id
 * @property string $code 权限code
 * @property string $name 权限名称
 * @property string $action 权限标识
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['code'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 64],
            [['action'], 'string', 'max' => 1000],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'action' => 'Action',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
