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
 * @property string|null $title
 * @property string|null $death_place
 * @property string|null $honor
 * @property string|null $quote
 * @property string|null $quote_source
 * @property string|null $biography
 * @property string|null $photo_large
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
            [['introduction', 'biography', 'quote', 'honor'], 'string'],
            [['name', 'birth_place', 'photo', 'title', 'death_place', 'quote_source', 'photo_large'], 'string', 'max' => 255],
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
            'birth_year' => '出生年份',
            'death_year' => '牺牲年份',
            'birth_place' => '籍贯',
            'introduction' => '事迹简介',
            'photo' => '照片',
            'title' => '头衔/职务',
            'death_place' => '牺牲地点',
            'honor' => '荣誉',
            'quote' => '名言/诗作',
            'quote_source' => '名言出处',
            'biography' => '生平事迹',
            'photo_large' => '大图',
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
