<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property string $id
 * @property string $code 课程编码
 * @property string $name 标题
 * @property string $short_name 副标题
 * @property string $cover 封面
 * @property string $for_people 适用人群
 * @property int $type 类型：0 视频 1 音频 2 图文
 * @property string $source_url 资源地址 图文默认为空
 * @property string $detail 详情
 * @property string $learn_count 学习人数
 * @property string $show_learn_count 学习人数基数
 * @property int $is_recommend 是否推荐
 * @property int $sort 排序
 * @property int $is_release 是否已发布：0 否 1 是
 * @property string $create_uuid 创建人
 * @property string $update_uuid 修改人
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 更新时间
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'learn_count', 'show_learn_count', 'sort', 'is_release'], 'integer'],
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['code', 'create_uuid', 'update_uuid'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 50],
            [['short_name'], 'string', 'max' => 100],
            [['cover', 'source_url'], 'string', 'max' => 256],
            [['for_people'], 'string', 'max' => 200],
            [['detail'], 'string', 'max' => 5000],
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
            'cover' => 'Cover',
            'for_people' => 'For People',
            'type' => 'Type',
            'source_url' => 'Source Url',
            'detail' => 'Detail',
            'learn_count' => 'Learn Count',
            'show_learn_count' => 'Show Learn Count',
            'sort' => 'Sort',
            'is_release' => 'Is Release',
            'create_uuid' => 'Create Uuid',
            'update_uuid' => 'Update Uuid',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
        ];
    }
}
