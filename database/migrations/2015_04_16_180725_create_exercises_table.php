<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercises', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('class_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('active');
            $table->enum('type', ['math']);
			$table->timestamps();
            
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exercises');
	}

}
