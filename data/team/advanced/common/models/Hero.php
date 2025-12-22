<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "hero".
 *
 * @property int $id
 * @property string $name
 * @property int|null $birth_year
 * @property int|null $death_year
 * @property string|null $birth_place
 * @property string|null $introduction
 * @property string|null $photo
 */
class Hero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['birth_year', 'death_year'], 'integer'],
            [['introduction'], 'string'],
            [['name', 'birth_place', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'birth_date' => '出生日期',
            'death_date' => '牺牲日期',
            'hometown' => '籍贯',
            'description' => '事迹简介',
            'image' => '照片',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    public function getLifeYears()
    {
        return $this->birth_year . ' - ' . $this->death_year;
    }

    /**
     * 获取关联的时间轴事件
     */
    public function getTimelines()
    {
        return $this->hasMany(Timeline::class, ['related_hero_id' => 'id'])->orderBy(['date' => SORT_ASC]);
    }
}
