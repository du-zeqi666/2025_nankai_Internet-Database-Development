<?php

use yii\db\Migration;

class m251211_000000_add_army_rank_to_hero extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%hero}}', 'army', $this->string(64)->defaultValue('')->after('photo'));
        $this->addColumn('{{%hero}}', 'rank', $this->string(64)->defaultValue('')->after('army'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%hero}}', 'rank');
        $this->dropColumn('{{%hero}}', 'army');
    }
}
