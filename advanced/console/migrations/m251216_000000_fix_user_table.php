<?php

use yii\db\Migration;

/**
 * Class m251216_000000_fix_user_table
 */
class m251216_000000_fix_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'auth_key', $this->string(32)->notNull()->defaultValue(''));
        $this->addColumn('{{%user}}', 'password_reset_token', $this->string()->unique());
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
        $this->addColumn('{{%user}}', 'status', $this->smallInteger()->notNull()->defaultValue(10));
        $this->addColumn('{{%user}}', 'created_at', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('{{%user}}', 'updated_at', $this->integer()->notNull()->defaultValue(0));
        
        // Update existing users to have valid data
        $this->update('{{%user}}', [
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'auth_key');
        $this->dropColumn('{{%user}}', 'password_reset_token');
        $this->dropColumn('{{%user}}', 'verification_token');
        $this->dropColumn('{{%user}}', 'status');
        $this->dropColumn('{{%user}}', 'created_at');
        $this->dropColumn('{{%user}}', 'updated_at');
    }
}
