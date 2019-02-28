<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('task');
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedTinyInteger('tag_id')->default(0);
            $table->string('content',100);
            $table->unsignedTinyInteger('sequence')->default(99)->comment('Sorting');
            $table->unsignedTinyInteger('status')->default(1)->comment('1:pending;2:finish;3:delete');
            $table->string('color',20)->nullable();
            $table->string('percent',20)->default(0);
            $table->string('working_time',20)->default(0)->comment('minutes spent on this task');
            $table->date('deadline')->nullable()->comment('default today');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
}
