<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "user_paper_question".
 *
 * @property string $id
 * @property string $code 唯一编码
 * @property string $user_paper_code 考卷编码
 * @property string $content 内容
 * @property string $answer 用户的答案
 * @property int $style 题型：0 - 单选、1 - 多选、2 - 填空、3 - 叙述
 * @property int $sort 序号
 * @property string $score 分数
 * @property int $is_right 是否正确：0 - 错误，1 - 正确
 * @property string $gmt_create 记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class UserPaperQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_paper_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['style', 'sort', 'is_right'], 'integer'],
            [['score'], 'number'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['code', 'user_paper_code'], 'string', 'max' => 32],
            [['content', 'answer'], 'string', 'max' => 256],
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
            'user_paper_code' => 'User Paper Code',
            'content' => 'Content',
            'answer' => 'Answer',
            'style' => 'Style',
            'sort' => 'Sort',
            'score' => 'Score',
            'is_right' => 'Is Right',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
