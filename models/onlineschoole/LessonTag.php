<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "lesson_tag".
 *
 * @property string $id
 * @property string $tag_code 标签code
 * @property string $lesson_code 课程code
 * @property int $is_release 对应资源是否已发布：0 否 1 是
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 更新时间
 */
class LessonTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_release'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['tag_code', 'lesson_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_code' => 'Tag Code',
            'lesson_code' => 'Lesson Code',
            'is_release' => 'Is Release',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
