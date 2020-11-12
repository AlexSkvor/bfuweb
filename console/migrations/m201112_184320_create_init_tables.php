<?php

use yii\db\Migration;

/**
 * Class m201112_184320_create_init_tables
 */
class m201112_184320_create_init_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		echo "m201112_184320_create_init_tables Creating managers.\n";
		$this->createTable('managers', [
            'id' => $this->string(),
            'fullName' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'phone' => $this->string()->notNull()->unique(),
            'login' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
		
		$this->addPrimaryKey('managers_pkey', 'managers', ['id']);
		echo "m201112_184320_create_init_tables Managers table created succesfully.\n";
		
		echo "m201112_184320_create_init_tables Creating clients.\n";
		$this->createTable('clients', [
            'id' => $this->string(),
            'fullName' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'phone' => $this->string()->notNull()->unique(),
            'login' => $this->string()->notNull()->unique(),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
		
		$this->addPrimaryKey('clients_pkey', 'clients', ['id']);

		echo "m201112_184320_create_init_tables Clients table created succesfully.\n";
		
		
		echo "m201112_184320_create_init_tables Creating calls.\n";
		$this->createTable('calls', [
            'id' => $this->string(),
            'managerId' => $this->string()->notNull(),
            'clientId' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'beginTime' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
		
		$this->addPrimaryKey('calls_pkey', 'calls', ['id']);
		
		// creates index for column `managerId`
        $this->createIndex(
            'idx-calls-managerId',
            'calls',
            'managerId'
        );
		
		// add foreign key for table `managers`
        $this->addForeignKey(
            'fk-calls-managerId',
            'calls',
            'managerId',
            'managers',
            'id',
            'CASCADE'
        );
		
		// creates index for column `clientId`
        $this->createIndex(
            'idx-calls-clientId',
            'calls',
            'clientId'
        );
		
		// add foreign key for table `clients`
        $this->addForeignKey(
            'fk-calls-clientId',
            'calls',
            'clientId',
            'clients',
            'id',
            'CASCADE'
        );
		
		echo "m201112_184320_create_init_tables Calls table created succesfully.\n";
		
		echo "m201112_184320_create_init_tables Creating courses.\n";
		$this->createTable('courses', [
            'id' => $this->string(),
            'name' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
		
		$this->addPrimaryKey('courses_pkey', 'courses', ['id']);

		echo "m201112_184320_create_init_tables Courses table created succesfully.\n";
		
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201112_184320_create_init_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201112_184320_create_init_tables cannot be reverted.\n";

        return false;
    }
    */
}
