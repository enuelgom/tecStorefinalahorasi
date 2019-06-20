<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre');
			$table->text('descripcion', 65535);
			$table->integer('cantidad');
			$table->float('precio', 10, 0);
			$table->boolean('status');
			$table->integer('id_usuario')->index('fk_productos_1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productos');
	}

}
