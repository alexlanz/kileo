<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMathExercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mathexercises', function(Blueprint $table)
		{
			$table->unsignedInteger('id');
            
            $table->integer('from');
            $table->integer('to');
            $table->unsignedInteger('num_of_calculations');
            
            $table->foreign('id')->references('id')->on('exercises')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('mathexercises');
	}

}
