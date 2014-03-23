<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountants', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('accountant_name');
			$table->string('accountancy_name')->nullable();
			$table->string('address');
			$table->string('logo_filename');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountants');
	}

}
