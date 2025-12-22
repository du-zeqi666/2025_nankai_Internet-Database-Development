<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "memorial_site".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $province
 * @property string|null $city
 * @property string $description
 * @property string|null $opening_hours
 * @property string|null $contact_phone
 */
class MemorialSite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memorial_site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name', 'address', 'opening_hours'], 'string', 'max' => 255],
            [['province', 'city', 'contact_phone'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'address' => '地址',
            'province' => '省份',
            'city' => '城市',
            'description' => '描述',
            'opening_hours' => '开放时间',
            'contact_phone' => '联系电话',
        ];
    }
}
