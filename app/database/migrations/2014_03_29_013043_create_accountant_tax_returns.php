<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantTaxReturns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_tax_returns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('value');
			$table->integer('accountant_id')->unsigned()->index();
			$table->integer('tax_return_id')->unsigned()->index();

			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
			$table->foreign('tax_return_id')->references('id')->on('tax_returns')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_tax_returns');
	}

}
