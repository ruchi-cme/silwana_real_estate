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
        Schema::create('project_master', function (Blueprint $table) {
            $table->increments('project_id');
            $table->string('project_name') ;
            $table->text('project_detail');
            $table->string('category_id')->comment('From category_master');
            $table->string('maintenance')->nullable();
            $table->tinyInteger('work_status')->comment('1- upcoming,2-ready_for_sale' );
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
        Schema::dropIfExists('projects');
    }
};
