<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "historical_relic".
 *
 * @property int $id
 * @property string $name
 * @property string $category
 * @property string $era
 * @property string $description
 * @property string $current_location
 * @property string|null $image
 */
class HistoricalRelic extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%historical_relic}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category', 'era', 'description', 'current_location'], 'required'],
            [['description'], 'string'],
            [['name', 'category', 'era', 'current_location', 'image'], 'string', 'max' => 255],
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
            'description' => '描述',
            'current_location' => '现藏地点',
            'image' => '图片',
        ];
    }
}
