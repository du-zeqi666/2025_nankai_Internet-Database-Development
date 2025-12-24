<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "timeline".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string|null $image
 * @property int|null $related_battle_id
 * @property int|null $related_hero_id
 */
class Timeline extends ActiveRecord
{
    public static function tableName()
    {
        return 'timeline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'title', 'description'], 'required'],
            [['date'], 'safe'],
            [['description'], 'string'],
            [['related_battle_id', 'related_hero_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => '日期',
            'title' => '事件标题',
            'description' => '事件描述',
            'image' => '事件图片',
            'related_battle_id' => '关联战役',
            'related_hero_id' => '关联英雄',
        ];
    }

    /**
     * 获取年份
     */
    public function getYear()
    {
        return date('Y', strtotime($this->date));
    }

    /**
     * 获取内容（兼容旧代码）
     */
    public function getContent()
    {
        return $this->description;
    }

    /**
     * 获取时间轴事件（按时间正序，仅显示历史事件，过滤掉个人和战役专属事件）
     */
    public static function getTimelineEvents()
    {
        return self::find()
            ->where(['related_battle_id' => null, 'related_hero_id' => null])
            ->orderBy(['date' => SORT_ASC])
            ->all();
    }

    /**
     * 格式化日期（显示用）
     */
    public function getFormattedDate()
    {
        return Yii::$app->formatter->asDate($this->date, 'php:Y-m-d');
    }
}
