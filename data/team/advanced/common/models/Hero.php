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
            'birth_year' => '出生年份',
            'death_year' => '牺牲年份',
            'birth_place' => '籍贯',
            'introduction' => '事迹简介',
            'photo' => '照片',
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
