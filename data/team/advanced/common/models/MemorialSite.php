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
 * @property string|null $opening
 * @property string|null $phone
 * @property string|null $details
 * @property string|null $transport
 * @property string|null $website
 * @property string|null $image
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
            [['name', 'address', 'province', 'city', 'description', 'opening'], 'required'],
            [['details'], 'string'],
            [['name', 'address', 'description', 'transport', 'website', 'image'], 'string', 'max' => 255],
            [['province', 'city', 'phone', 'opening'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '场馆全名',
            'address' => '详细地址',
            'province' => '省份',
            'city' => '城市',
            'description' => '简要描述',
            'opening' => '开馆时间',
            'phone' => '联系电话',
            'transport' => '交通建议',
            'details' => '详细介绍',
            'website' => '官方网站',
            'image' => '图片路径',
        ];
    }
}
