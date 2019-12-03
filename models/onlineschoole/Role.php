<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property string $code 角色code
 * @property string $name 角色名
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
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
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
