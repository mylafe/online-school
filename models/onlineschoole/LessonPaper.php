<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "lesson_paper".
 *
 * @property string $id
 * @property string $lesson_code 课程code
 * @property string $paper_code 试卷code
 * @property string $create_time 创建时间
 * @property string $update_time 更新时间
 */
class LessonPaper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson_paper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['lesson_code', 'paper_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lesson_code' => 'Lesson Code',
            'paper_code' => 'Paper Code',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
