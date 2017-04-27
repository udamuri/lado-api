<?php

use yii\db\Migration;

class m170427_012531_example extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%example}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'email' => $this->string(32)->notNull()->unique(),
            'blog' => $this->string(100),
            'company' => $this->string(100),
            'bio' => $this->string(255)
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%example}}');
    }
}
