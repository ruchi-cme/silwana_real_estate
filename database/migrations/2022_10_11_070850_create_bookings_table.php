<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bookings');
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->integer('user_id')->comment('From users table' );
            $table->integer('unit_id')->comment('From proj_floor_unit_mapping table' );
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('booking_price');
            $table->text('booking_details')->nullable();
            $table->tinyInteger('booking_type')->comment('1- cash, 2-onsite' );
            $table->tinyInteger('payment_type')->comment('1- cash, 2-online, 3-card' );
            $table->string('paid_via')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-booking_price_paid, 2-fully Aamount Paid,3-cancel' );
            $table->integer('created_by')->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('modified_by')->nullable();
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('canceled')->default(0)->comment('1- canceled' );
            $table->timestamp('canceled_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('canceled_by')->nullable();
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
};
