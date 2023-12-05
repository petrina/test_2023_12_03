<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tenders}}`.
 */
class m231201_044921_create_tenders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tenders}}', [
            'table_id' => $this->primaryKey(),
            'id' => $this->string()->notNull(),
            'tenderID' => $this->string()->notNull(),
            'description' => $this->text(),
            'amount' => $this->decimal(15, 2),
            'dateModified' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tenders}}');
    }
}
