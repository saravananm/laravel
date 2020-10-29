<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('division');
            $table->string('title');
            $table->string('slug');
            $table->mediumText('short_message');
            $table->longText('message');
            $table->string('image_name');
            $table->mediumText('image_content');
            $table->date('datefor');
            $table->string('author');
            $table->enum('cover_image', ['1', '0']);
            $table->enum('status', ['1', '0']);
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
        Schema::dropIfExists('posts');
    }
}
