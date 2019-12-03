<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "paper".
 *
 * @property string $id
 * @property string $code 唯一编码
 * @property string $name 名称
 * @property string $start_at 开始时间
 * @property string $end_at 结束时间
 * @property string $duration 时长
 * @property int $total_score 总分
 * @property int $pass_score 及格分
 * @property int $radio_count 单选题个数
 * @property string $radio_score 单选题分数
 * @property int $check_count 多选题个数
 * @property string $check_score 多选题分数
 * @property string $gmt_create 记录的创建时间
 * @property string $gmt_modified 记录的更新时间
 */
class Paper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at', 'duration', 'total_score', 'pass_score', 'radio_count', 'check_count'], 'integer'],
            [['radio_score', 'check_score'], 'number'],
            [['gmt_create', 'gmt_modified'], 'safe'],
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
            'start_at' => 'Start At',
            'end_at' => 'End At',
            'duration' => 'Duration',
            'total_score' => 'Total Score',
            'pass_score' => 'Pass Score',
            'radio_count' => 'Radio Count',
            'radio_score' => 'Radio Score',
            'check_count' => 'Check Count',
            'check_score' => 'Check Score',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
