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
        Schema::create('our_project_homes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->text('detail');
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
        Schema::dropIfExists('our_project_homes');
    }
};
