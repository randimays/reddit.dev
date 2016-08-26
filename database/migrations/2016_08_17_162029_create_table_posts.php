<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration {

    public function up() {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('img_path')->nullable();
            $table->string('url');
            $table->text('content');
            $table->integer('vote_score')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('posts');
    }
}