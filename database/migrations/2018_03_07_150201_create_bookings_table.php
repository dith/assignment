<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('booking_id');
            $table->timestamp('created_at_local');
            $table->integer('driver_id');
            $table->integer('passenger_id');
            $table->enum('state', ['COMPLETED', 'CANCELLED_PASSENGER', 'CANCELLED_DRIVER']);
            $table->integer('country_id');
            $table->decimal('fare', 12, 2);
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
