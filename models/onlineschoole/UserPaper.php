<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "user_paper".
 *
 * @property string $id
 * @property string $code 唯一编码
 * @property string $uuid uuid
 * @property string $name 名称
 * @property int $total_score 总分
 * @property int $pass_score 及格分
 * @property string $score 得分
 * @property int $is_pass 是否通过：0 否、1 是
 * @property string $duration 时长
 * @property int $status 状态：0 - 未答题、1- 答题中、2 - 结束答题
 * @property string $start_at 开始答题时间
 * @property string $en_at 交卷时间
 * @property string $work_duration 答题时长
 * @property string $gmt_create 记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class UserPaper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_paper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_score', 'pass_score', 'is_pass', 'duration', 'status', 'start_at', 'en_at', 'work_duration'], 'integer'],
            [['score'], 'number'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['code', 'uuid'], 'string', 'max' => 32],
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
            'uuid' => 'Uuid',
            'name' => 'Name',
            'total_score' => 'Total Score',
            'pass_score' => 'Pass Score',
            'score' => 'Score',
            'is_pass' => 'Is Pass',
            'duration' => 'Duration',
            'status' => 'Status',
            'start_at' => 'Start At',
            'en_at' => 'En At',
            'work_duration' => 'Work Duration',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
