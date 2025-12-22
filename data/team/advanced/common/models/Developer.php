<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Developer model
 *
 * @property string $id      学号（主键）
 * @property string $name    姓名
 * @property string $college 学院
 * @property string $content 主要负责内容
 */
class Developer extends ActiveRecord
{
    public static function tableName()
    {
        return 'developer';
    }

    public function rules()
    {
        return [
            [['id', 'name', 'college'], 'required'],
            [['content'], 'string'],
            [['id'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 50],
            [['college'], 'string', 'max' => 100],
        ];
    }
}
