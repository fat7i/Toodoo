<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreateParticipantTodoListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_todo_list', function (Blueprint $table) {
            $table->integer('participant_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants');

            $table->integer('todo_list_id')->unsigned();
            $table->foreign('todo_list_id')->references('id')->on('todo_lists');

            $table->unique(['participant_id', 'todo_list_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('participant_todo_list');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
