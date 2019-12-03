<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "role_access".
 *
 * @property string $id
 * @property string $role_code 角色code
 * @property string $access_code 权限code
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class RoleAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['role_code', 'access_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_code' => 'Role Code',
            'access_code' => 'Access Code',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
