<?php

use yii\db\Schema;
use yii\db\Migration;

class m160707_124923_advice extends Migration
{
    public function safeUp()
    {
	$this->createTable('advice', [
	    'id' => Schema::TYPE_PK,
	    'title' => Schema::TYPE_STRING,
	    'image' => 'varchar(6)',
	    'description' => Schema::TYPE_TEXT,
	]);
        return true;
    }

    public function safeDown()
    {
	$this->dropTable('advice');
        return true;
    }
}
