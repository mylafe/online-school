<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "paper_question".
 *
 * @property string $id
 * @property string $paper_code 唯一编码
 * @property string $question_code 唯一编码
 * @property int $sort 序号
 * @property int $score 分数
 * @property string $gmt_create 记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class PaperQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paper_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'score'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['paper_code', 'question_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paper_code' => 'Paper Code',
            'question_code' => 'Question Code',
            'sort' => 'Sort',
            'score' => 'Score',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
