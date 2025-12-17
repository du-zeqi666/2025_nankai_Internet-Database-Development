<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property string $config_key
 * @property string $config_value
 * @property string $config_name
 * @property string $config_group
 * @property int $sort_order
 */
class Config extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['config_key', 'config_name'], 'required'],
            [['config_value'], 'string'],
            [['sort_order'], 'integer'],
            [['config_key', 'config_name', 'config_group'], 'string', 'max' => 255],
            [['config_key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'config_key' => '配置键',
            'config_value' => '配置值',
            'config_name' => '配置名称',
            'config_group' => '配置分组',
            'sort_order' => '排序',
        ];
    }
}
