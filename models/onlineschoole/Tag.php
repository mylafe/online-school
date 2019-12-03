<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property string $id
 * @property string $code 标识符
 * @property string $name 标签名称
 * @property string $short_name 标签副名称
 * @property int $pv 点击量
 * @property int $is_delete 是否删除：0 否，1 是
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 更新时间
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pv', 'is_delete'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['code'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 80],
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
            'short_name' => 'Short Name',
            'pv' => 'Pv',
            'is_delete' => 'Is Delete',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
