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

            // foreign keys [ another example: $table->foreign('user_id')->references('id')->on('users'); ]
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('agency_id')->nullable()->constrained()->onDelete('cascade');

            $table->enum('estate_type', ['New Apartment', 'Apartment', 'House-Villa', 'Office', 'Garage', 'Land']);

            $table->string('city');
            $table->integer('area');
            $table->integer('room_count');
            $table->text('address');
            $table->text('district');

            $table->string('apartment_floor');
            $table->string('total_floors');

            $table->longText('description');
            $table->integer('price');

            $table->string('contact_email');
            $table->string('contact_phone_number');

            $table->enum('trade_type', ['sell', 'rent']);
            $table->enum('realtor_type', ['self', 'agent']);

            $table->boolean('is_vip');
            $table->boolean('has_voucher');

            $table->integer('views_today');
            $table->integer('views_total');
            
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
