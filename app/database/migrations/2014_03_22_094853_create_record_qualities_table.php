<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecordQualitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('record_qualities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->double('percentage');
			$table->integer('accounting_type_id')->unsigned()->index();
			$table->foreign('accounting_type_id')->references('id')->on('accounting_types')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('record_qualities');
	}

}
