<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('phone');
            $table->string('booking_at');
            $table->string('vehicle_status');
            $table->string('from_area');
            $table->string('from_address');
            $table->string('to_area');
            $table->string('to_address');
            $table->string('vehicle_type');
            $table->string('vehicle_brand');
            $table->char('own_key',7);
            $table->char('own_license',7);
            $table->char('owner',7);
            $table->string('status');
            $table->string('price');
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
        Schema::dropIfExists('bookings');
    }
}
