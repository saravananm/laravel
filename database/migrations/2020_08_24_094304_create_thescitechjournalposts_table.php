<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThescitechjournalpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thescitechjournalposts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coverimages_id');
            $table->foreignId('tag_id');
            $table->string('title');
            $table->string('slug');
            $table->mediumText('short_message');
            $table->longText('message');
            $table->string('image_name');
            $table->date('datefor');
            $table->string('author');
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
        Schema::dropIfExists('thescitechjournalposts');
    }
}
