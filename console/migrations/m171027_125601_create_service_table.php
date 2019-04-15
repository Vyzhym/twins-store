<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m171027_125601_create_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'value' => $this->string(255)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('service');
    }
}
