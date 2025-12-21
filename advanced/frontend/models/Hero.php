<?php
namespace frontend\models;

use yii\db\ActiveRecord;

class Hero extends ActiveRecord
{
    public static function tableName()
    {
        return 'hero';
    }

    // 只返回前端可能需要的字段
    public function fields()
    {
        return [
            'id',
            'name',
            'birth_year',
            'death_year',
            'brief',
            'bio',
            'photo'
        ];
    }
    public function getLifeYears()
    {
        return $this->birth_year . ' - ' . $this->death_year;
    }
}
