<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property string $id
 * @property string $code 唯一编码
 * @property string $content 内容
 * @property int $style 题型：0 单选 1 多选 2 填空 3 叙述
 * @property string $gmt_create 记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['style'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['code'], 'string', 'max' => 32],
            [['content'], 'string', 'max' => 256],
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
            'content' => 'Content',
            'style' => 'Style',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
