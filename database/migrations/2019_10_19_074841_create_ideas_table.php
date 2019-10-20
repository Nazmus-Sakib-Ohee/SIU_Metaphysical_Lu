<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable(false);
            $table->string('title')->nullable(false);
            $table->string('image')->nullable(true);
            $table->text('description')->nullable(false);
            $table->string('pptx')->nullable(true);
            $table->string('status')->nullable(false);
            $table->integer('up_vote')->nullable(false);
            $table->integer('down_vote')->nullable(false);
            $table->integer('view')->nullable(false);
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
        Schema::dropIfExists('ideas');
    }
}
