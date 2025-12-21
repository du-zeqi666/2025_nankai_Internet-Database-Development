<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "battle".
 *
 * @property int $id
 * @property string $name
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $location
 * @property string $description
 * @property string|null $result
 * @property string|null $significance
 * @property string|null $detail_image
 * @property string|null $map_image
 */
class Battle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'battle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start_date', 'location', 'description'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['description', 'significance'], 'string'],
            [['name', 'location', 'detail_image', 'map_image'], 'string', 'max' => 255],
            [['result'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '战役名称',
            'start_date' => '开始日期',
            'end_date' => '结束日期',
            'location' => '发生地点',
            'description' => '战役描述',
            'result' => '战役结果',
            'significance' => '历史意义',
            'image' => '图片',
            'detail_image' => '详情图片',
            'map_image' => '地图图片',
        ];
    }
    public function getDuration()
    {
        return $this->start_date . ' - ' . $this->end_date;
    }
}
