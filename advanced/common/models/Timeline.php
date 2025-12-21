<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "historical_event".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $event_date
 * @property string|null $location
 * @property int|null $importance_level
 * @property string|null $cover_image
 */
class Timeline extends ActiveRecord
{
    public static function tableName()
    {
        return 'historical_event';
    }

    /**
     * 获取时间轴事件（按时间正序）
     */
    public static function getTimelineEvents()
    {
        return self::find()
            ->orderBy(['event_date' => SORT_ASC])
            ->all();
    }

    /**
     * 格式化日期（显示用）
     */
    public function getFormattedDate()
    {
        return Yii::$app->formatter->asDate($this->event_date, 'php:Y-m-d');
    }
}
