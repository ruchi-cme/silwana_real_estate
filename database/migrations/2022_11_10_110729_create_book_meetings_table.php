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
        Schema::dropIfExists('book_meetings');
        Schema::create('book_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();;
            $table->integer('booked_by')->nullable();;
            $table->string('name');
            $table->string('phone')->nullable();;
            $table->string('email');
            $table->date('date');
            $table->time('time');
            $table->text('detail')->nullable();
            $table->enum('status', ['booked', 'success', 'cancelled','reschedule' ,'Not_attended'])->default('booked')->comment('booked,success,cancelled, reschedule,Not_attended' );;
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
        Schema::dropIfExists('book_meetings');
    }
};
