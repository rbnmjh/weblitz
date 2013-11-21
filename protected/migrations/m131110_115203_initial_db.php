<?php

class m131110_115203_initial_db extends CDbMigration
{
	public function up()
	{
		$this->createTable('admin_user', array(
            'id' => 'pk',
            'user' => 'varchar(255) NOT NULL',
            'email' => 'varchar(255) NOT NULL',
            'password' => 'varchar(255) NOT NULL',
            'role' => 'varchar(255)',
            'is_active' => 'tinyint(1) DEFAULT 0',
        ));

        $this->createTable('ourteam', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'image' => 'varchar(255) NOT NULL',
            'content' => 'text',
            'status' => 'enum("0","1")',
        ));

		$this->createTable('portfolio', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'image'=> 'varchar(255) NOT NULL',
            'url'=> 'varchar(255)',
            'content' => 'text',
            'status' => 'enum("0","1")',
        ));

        $this->createTable('contactus', array(
            'id' => 'pk',
            'email' => 'varchar(255) NOT NULL',
            'message' => 'text',
        ));

        $this->createTable('pages', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'content' => 'text',
            'image'=> 'varchar(255)',
            'status' => 'enum("0","1")',
        ));

        $this->createTable('sitesetting', array(
            'id' => 'pk',
            'site_email' => 'varchar(255) NOT NULL',
            'phone' => 'decimal(12, 0)',
            'location'=> 'varchar(255)',
            'lat' => 'decimal(7, 6)',
            'lon' => 'decimal(7, 6)',
        ));

        $this->createTable('testimonial', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'company' => 'varchar(255)',
            'position'=> 'varchar(255)',
            'image' => 'varchar(255)',
            'message' => 'text',
        ));
	}

	public function down()
	{
		echo "m131110_115203_initial_db does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}