<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountantBookkeeping extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accountant_bookkeepings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('hour_val');
			$table->double('day_val');
			$table->integer('accountant_id')->unsigned()->index();
			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
		});

		Schema::table('pricings', function(Blueprint $table)
		{
			$table->dropColumn('bookkeeping_hour_val', 'bookkeeping_day_val');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accountant_bookkeepings');
	}

}
