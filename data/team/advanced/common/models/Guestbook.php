<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "guestbook".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $visitor_name
 * @property string $content
 * @property string|null $reply_content
 * @property int $created_at
 */
class Guestbook extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guestbook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visitor_name', 'content', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['content', 'reply_content'], 'string'],
            [['visitor_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'visitor_name' => '访客姓名',
            'content' => '留言内容',
            'reply_content' => '回复内容',
            'created_at' => '留言时间',
        ];
    }
}
