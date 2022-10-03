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
        Schema::create('silwana_details_mapping', function (Blueprint $table) {
            $table->increments('silwana_dtl_mpg_id');
            $table->unsignedBigInteger('silwana_detail_id')->comment('From silwana_detail_master table' );
            $table->string('icon')->nullable();
            $table->string('heading')->nullable();
            $table->text('heading_detail')->nullable();
            $table->string('heading_image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1- Active,2-InActive' );
            /* Status :  1- Active,2-InActive */
            $table->integer('created_by')->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('modified_by')->nullable();
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
         //   $table->foreign('silwana_detail_id')->references('silwana_detail_id')->on('silwana_detail_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('silwana_details_mapping');
    }
};
