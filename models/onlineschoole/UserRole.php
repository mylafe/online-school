<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "user_role".
 *
 * @property string $id
 * @property string $auid 管理员auid
 * @property string $role_code 角色code
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['auid', 'role_code'], 'string', 'max' => 32],
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
            'role_code' => 'Role Code',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
