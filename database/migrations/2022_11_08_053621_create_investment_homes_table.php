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
        Schema::dropIfExists('investment_homes');
        Schema::create('investment_homes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('detail');
            $table->text('sub_title');
            $table->string('name');
            $table->string('video_title')->nullable();
            $table->string('image_title')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1- Active,2-InActive' );
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
        Schema::dropIfExists('investment_homes');
    }
};
