<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "question_option".
 *
 * @property string $id
 * @property string $question_code 试题编码
 * @property string $content 内容
 * @property int $sort 序号
 * @property int $is_answer 是否是正确选项：0 - 不是、1 - 是
 * @property string $gmt_create 记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class QuestionOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'is_answer'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['question_code'], 'string', 'max' => 32],
            [['content'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_code' => 'Question Code',
            'content' => 'Content',
            'sort' => 'Sort',
            'is_answer' => 'Is Answer',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
