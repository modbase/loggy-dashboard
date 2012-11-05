<?php

class Create_Tables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logitems', function($table)
		{
			$table->increments('id');
			$table->string('site_id');
			$table->integer('code');
			$table->string('message');
			$table->string('file');
			$table->integer('line');
			$table->text('trace');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logitems');
	}

}