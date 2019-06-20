<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToImagenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('imagen', function(Blueprint $table)
		{
			$table->foreign('id_producto', 'fk_imagen_1')->references('id')->on('productos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('imagen', function(Blueprint $table)
		{
			$table->dropForeign('fk_imagen_1');
		});
	}

}
