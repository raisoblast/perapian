<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checklist_id');
            $table->foreign('checklist_id')->references('id')->on('checklists');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->boolean('is_completed')->nullable()->default(false);
            $table->dateTime('due')->nullable();
            $table->smallInteger('urgency')->nullable()->default(0);
            $table->dateTime('completed_at')->nullable();
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
        Schema::dropIfExists('checklist_items');
    }
}
