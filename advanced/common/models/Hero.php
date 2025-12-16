<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hero".
 *
 * @property int $id
 * @property string $name
 * @property string|null $alias
 * @property string|null $title
 * @property int|null $birth_year
 * @property int|null $death_year
 * @property string|null $birth_place
 * @property string|null $death_place
 * @property string $introduction
 * @property string|null $biography
 * @property string|null $heroic_deeds
 * @property string|null $photo
 * @property string|null $photo_large
 * @property string|null $army
 * @property string|null $rank
 * @property string|null $honor
 * @property string|null $quote
 * @property string|null $quote_source
 *
 * @property Timeline[] $timelines
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
            [['name', 'introduction'], 'required'],
            [['birth_year', 'death_year'], 'integer'],
            [['introduction', 'biography', 'heroic_deeds', 'quote'], 'string'],
            [['name', 'alias', 'title', 'birth_place', 'death_place', 'photo', 'photo_large', 'army', 'rank', 'honor', 'quote_source'], 'string', 'max' => 255],
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
            'alias' => '别名',
            'title' => '头衔',
            'birth_year' => '出生年份',
            'death_year' => '牺牲年份',
            'birth_place' => '出生地',
            'death_place' => '牺牲地',
            'introduction' => '简介',
            'biography' => '生平',
            'heroic_deeds' => '英雄事迹',
            'photo' => '照片',
            'photo_large' => '大图',
            'army' => '所属部队',
            'rank' => '军衔/职务',
            'honor' => '荣誉',
            'quote' => '名言',
            'quote_source' => '名言出处',
        ];
    }

    /**
     * Gets query for [[Timelines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimelines()
    {
        return $this->hasMany(Timeline::class, ['related_hero_id' => 'id']);
    }
    
    public function getLifeYears()
    {
        if ($this->birth_year && $this->death_year) {
            return $this->birth_year . ' - ' . $this->death_year;
        }
        return '';
    }
}
