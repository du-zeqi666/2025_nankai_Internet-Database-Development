<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "historical_event".
 *
 * @property int $id
 * @property string $title
 * @property string|null $event_date
 * @property string|null $description
 * @property string|null $image
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class HistoricalEvent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historical_event';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'event_date'], 'required'],
            [['event_date'], 'safe'],
            [['description'], 'string'],
            [['importance_level'], 'integer'],
            [['title', 'location', 'cover_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '事件标题',
            'event_date' => '发生日期',
            'description' => '事件描述',
            'location' => '发生地点',
            'importance_level' => '重要程度',
            'cover_image' => '封面图片',
        ];
    }
}
