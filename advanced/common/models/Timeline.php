<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timeline".
 *
 * @property int $id
 * @property string $date
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property int|null $related_battle_id
 * @property int|null $related_hero_id
 *
 * @property Hero $hero
 */
class Timeline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timeline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'title', 'description'], 'required'],
            [['date'], 'safe'],
            [['description'], 'string'],
            [['related_battle_id', 'related_hero_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['related_hero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hero::class, 'targetAttribute' => ['related_hero_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => '日期',
            'title' => '标题',
            'description' => '描述',
            'image' => '图片',
            'related_battle_id' => '关联战役',
            'related_hero_id' => '关联英雄',
        ];
    }

    /**
     * Gets query for [[Hero]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHero()
    {
        return $this->hasOne(Hero::class, ['id' => 'related_hero_id']);
    }
    
    // 兼容旧代码的虚拟属性
    public function getYear()
    {
        return date('Y年', strtotime($this->date));
    }
    
    public function getContent()
    {
        return $this->description;
    }
}
