<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddModuleIdToClientModulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_modules', function(Blueprint $table)
		{
			$table->integer('module_id')->unsigned();
			$table->foreign('module_id')
				->references('id')->on('employee_period_ranges')
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
		Schema::table('client_modules', function(Blueprint $table)
		{
			$table->dropForeign('client_modules_module_id_foreign');
			$table->dropColumn('module_id');
		});
	}

}
