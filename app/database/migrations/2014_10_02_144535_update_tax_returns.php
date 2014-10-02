<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTaxReturns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tax_returns', function(Blueprint $table)
		{
			$table->boolean('user_defined');
		});

		Schema::create('tax_return_pricings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('qty');
			$table->integer('tax_return_id');
			$table->integer('pricing_id')->unsigned()->index();
			$table->foreign('pricing_id')->references('id')->on('pricings')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
