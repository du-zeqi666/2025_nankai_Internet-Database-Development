<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "historical_relic".
 *
 * @property int $id
 * @property string $name
 * @property string $category
 * @property string $era
 * @property string $description
 * @property string $current_location
 * @property string|null $image
 */
class HistoricalRelic extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%historical_relic}}';
    }
}
