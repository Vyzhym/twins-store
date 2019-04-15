<?php

use yii\db\Migration;

class m161130_090206_add_admin_user extends Migration
{
    public function up()
    {
        $this->insert('user',[
            'id' => 1,
            'username' => 'developer',
            'password_hash' => Yii::$app->security->generatePasswordHash('33esutet'),
            'email' => 'vyzhym@gmail.com'
        ]);
        $this->insert('user',[
            'id' => 2,
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('33esutet'),
            'email' => 'no_email@no_email.com'
        ]);
    }

    public function down()
    {
        $this->delete('user', 'id=1');
        $this->delete('user', 'id=2');
    }

}
