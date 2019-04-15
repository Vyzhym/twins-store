<?php

use yii\db\Migration;

/**
 * Handles the creation of table `file`.
 */
class m171027_125546_create_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'file' => $this->string(30)->notNull(),
            'title' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('file');
    }
}
