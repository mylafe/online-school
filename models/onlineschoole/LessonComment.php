<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "lesson_comment".
 *
 * @property string $id
 * @property string $code 唯一标识
 * @property string $uuid 用户uuid
 * @property string $lesson_code 课程code
 * @property string $content 评论内容
 * @property int $level 级别 1 很差 2 差 3 一般 4 好 5 很好
 * @property int $is_top 是否置顶 0. 否 1. 是
 * @property int $is_delete 是否删除 0. 否 1. 是
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 修改时间
 */
class LessonComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'is_top', 'is_delete'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['code', 'uuid', 'lesson_code'], 'string', 'max' => 32],
            [['content'], 'string', 'max' => 2500],
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
            'lesson_code' => 'Lesson Code',
            'content' => 'Content',
            'level' => 'Level',
            'is_top' => 'Is Top',
            'is_delete' => 'Is Delete',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
