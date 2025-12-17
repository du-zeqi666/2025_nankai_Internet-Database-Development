<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $filename
 * @property string $filepath
 * @property string|null $type
 * @property int|null $size
 */
class Media extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename', 'filepath'], 'required'],
            [['size'], 'integer'],
            [['filename', 'filepath', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => '文件名',
            'filepath' => '文件路径',
            'type' => '类型',
            'size' => '大小',
            'created_at' => '上传时间',
            'updated_at' => '更新时间',
        ];
    }
}
