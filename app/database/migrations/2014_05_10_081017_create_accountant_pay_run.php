<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantPayRun extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_pay_runs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('accountant_id')->unsigned()->index();
			$table->double('value');
			$table->string('based_on');
			$table->double('allclients_base_fee')->nullable();
			$table->timestamps();
			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_pay_run');
	}

}
