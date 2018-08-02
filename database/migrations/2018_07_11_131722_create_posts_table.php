<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug');
            $table->text('short');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('publish_at')->nullable();
            $table->integer('views')->default(0);
            $table->boolean('is_visible')->default(1);
            $table->timestamps();
        });

        Schema::create('blog_post', function (Blueprint $table) {
            $table->integer('blog_id')->unsigned()->index();
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');

            $table->integer('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post');
        Schema::dropIfExists('posts');
    }
}
