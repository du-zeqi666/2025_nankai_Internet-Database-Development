<?php
namespace common\models;

use yii\db\ActiveRecord;

class Site extends ActiveRecord
{
    public static function tableName()
    {
        return 'memorial_site';
    }

    public function rules()
    {
        return [
            [['name', 'address', 'province', 'city', 'description'], 'required'],
            [['details'], 'string'],
            [['name', 'address', 'description', 'opening', 'phone', 'transport', 'website', 'image'], 'string', 'max' => 255],
            [['province', 'city'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '场馆名称',
            'address' => '地址',
            'province' => '省份',
            'city' => '城市',
            'description' => '简要描述',
            'opening' => '开放时间',
            'phone' => '联系电话',
            'transport' => '交通建议',
            'details' => '详细介绍',
            'website' => '官方网站',
            'image' => '场馆图片',
        ];
    }
}
