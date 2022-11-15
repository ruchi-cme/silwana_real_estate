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
        Schema::dropIfExists('invest_services');
        Schema::create('invest_services', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('sub_title');
                $table->text('detail');
                $table->string('image')->nullable();
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
        Schema::dropIfExists('invest_services');
    }
};
