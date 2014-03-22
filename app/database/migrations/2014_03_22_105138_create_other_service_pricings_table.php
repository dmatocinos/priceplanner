<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOtherServicePricingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('other_service_pricings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('qty');
			$table->integer('other_service_id');
			$table->integer('pricing_id')->unsigned()->index();
			$table->timestamps();
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
		Schema::drop('other_service_pricings');
	}

}
