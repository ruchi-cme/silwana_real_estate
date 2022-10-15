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
        Schema::dropIfExists('project_images');
        Schema::create('project_images', function (Blueprint $table) {
            $table->increments('project_image_id');
            $table->integer('project_id')->comment('From project_master');
            $table->string('title');
            $table->string('path');
            $table->string('direction')->nullable();
            $table->string('facing')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1- PDF,2-Image' );
            /* Status :  1- PDF,2-Image */
            $table->tinyInteger('status')->default(1)->comment('1- Active,2-InActive' );
            /* Status :  1- Active,2-InActive */
            $table->integer('created_by')->nullable();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('modified_by')->nullable();
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_images');
    }
};
