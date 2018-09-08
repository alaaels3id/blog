<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('user_id');
            $table->timestamps();
        });

        Schema::create('post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('post_id');
            $table->string('title');
            $table->text('body');
            $table->string('locale')->index();

            $table->unique(['post_id','locale']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_translations');
    }
}
