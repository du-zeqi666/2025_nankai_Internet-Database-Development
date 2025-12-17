<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "historical_relic".
 *
 * @property int $id
 * @property string $name
 * @property string|null $category
 * @property string|null $era
 * @property string $description
 * @property string|null $current_location
 * @property string|null $image
 */
class HistoricalRelic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historical_relic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name', 'current_location', 'image'], 'string', 'max' => 255],
            [['category', 'era'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文物名称',
            'category' => '类别',
            'era' => '年代',
            'description' => '文物描述',
            'current_location' => '现藏地点',
            'image' => '图片',
        ];
    }
}
