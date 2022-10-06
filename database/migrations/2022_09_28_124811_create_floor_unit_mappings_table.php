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
        Schema::dropIfExists('proj_floor_unit_mapping');
        Schema::create('proj_floor_unit_mapping', function (Blueprint $table) {
            $table->increments('proj_floor_unit_id');
            $table->integer('proj_block_floor_id')->comment('From proj_block_floor_dtl');
            $table->integer('category_id')->nullable();
            $table->string('unit_name');
            $table->string('facing')->nullable();;
            $table->string('overlooking')->nullable();
            $table->string('rooms')->nullable();
            $table->string('area_in_sq_feet')->nullable();
            $table->string('total_price')->nullable();
            $table->string('booking_price')->nullable();
            $table->tinyInteger('booking_type')->nullable()->default(0)->comment('1-Available, 2- Booked' );;
            $table->tinyInteger('status')->default(1)->comment('1- Active,2-InActive' );;
            /* Status :  1- Active,2-InActive */
            $table->integer('created_by')->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('modified_by')->nullable();
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('deleted')->default(0)->comment('1- Deleted' );
            $table->timestamp('deleted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floor_unit_mappings');
    }
};
