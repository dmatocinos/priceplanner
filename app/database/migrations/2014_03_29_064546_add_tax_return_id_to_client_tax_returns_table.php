<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTaxReturnIdToClientTaxReturnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_tax_returns', function(Blueprint $table)
		{
			$table->integer('tax_return_id')->unsigned();
			$table->foreign('tax_return_id')
				->references('id')->on('tax_returns')
				->onUpdate('cascade')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_tax_returns', function(Blueprint $table)
		{
			$table->dropForeign('client_tax_returns_tax_return_id_foreign');
			$table->dropColumn('tax_return_id');
		});
	}

}
