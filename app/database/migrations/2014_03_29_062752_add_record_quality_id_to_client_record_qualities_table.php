<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRecordQualityIdToClientRecordQualitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_record_qualities', function(Blueprint $table)
		{
			$table->integer('record_quality_id')->unsigned();
			$table->foreign('record_quality_id')
				->references('id')->on('record_qualities')
				->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_record_qualities', function(Blueprint $table)
		{
			$table->dropForeign('record_qualities_record_quality_id_foreign');
			$table->dropColumn('record_quality_id');
		});
	}

}
