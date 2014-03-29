<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemovePercentageFromRecordQualitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('record_qualities', function(Blueprint $table)
		{
			$table->dropColumn('percentage');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('record_qualities', function(Blueprint $table)
		{
			$table->double('percentage');
		});
	}

}