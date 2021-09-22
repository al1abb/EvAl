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
            $table->id();

            // foreign key
            //$table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id')->constrained();

            $table->enum('estate_type', ['new apartment', 'apartment', 'house-villa', 'office', 'garage', 'land']);
            $table->string('estate_city');
            $table->integer('estate_area');
            $table->longText('estate_description');
            $table->integer('estate_price');
            $table->text('estate_address');
            $table->text('estate_district');
            $table->integer('estate_viewsTotal');
            $table->integer('estate_viewsToday');
            $table->integer('estate_roomCount');
            $table->string('estate_apartmentFloor');
            $table->enum('estate_tradeType', ['sell', 'rent']);

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
