<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThescitechpostCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thescitechpost_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('thescitechpost_id');
            $table->foreignId('thescitechcategorie_id');
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
        Schema::dropIfExists('thescitechpost_categories');
    }
}
