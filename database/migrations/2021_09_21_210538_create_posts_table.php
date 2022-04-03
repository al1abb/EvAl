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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('agency_id')->nullable()->constrained()->onDelete('cascade');

            $table->integer('search_points')->default(0);

            $table->enum('estate_type', ['new_apartment', 'apartment', 'house_villa', 'office', 'garage', 'land']);

            $table->string('city');
            $table->integer('area');
            $table->enum('area_unit', ['room', 'land']);
            $table->integer('room_count');
            $table->text('address');
            $table->text('district');

            $table->integer('apartment_floor');
            $table->integer('total_floors');

            $table->longText('description');
            $table->integer('price');

            $table->string('contact_email');
            $table->string('contact_phone_number');
            $table->string('realtor_name')->nullable()->default(null);

            $table->enum('trade_type', ['sell', 'rent']);
            $table->enum('realtor_type', ['self', 'agent']);

            $table->boolean('is_vip')->default(false);
            $table->boolean('has_voucher')->default(false);

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
