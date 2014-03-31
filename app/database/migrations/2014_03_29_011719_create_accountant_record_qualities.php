<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantRecordQualities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_record_qualities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('percentage');
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('record_quality_id')->unsigned()->index();
			$table->integer('accounting_type_id')->unsigned()->index();

			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('record_quality_id')->references('id')->on('record_qualitiess')->onDelete('cascade');
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
		Schema::drop('accountant_record_qualities');
	}

}
