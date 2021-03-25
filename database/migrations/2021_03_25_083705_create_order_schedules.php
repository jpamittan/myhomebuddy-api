<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->date('schedule_date');
            $table->time('schedule_time');
            $table->integer('qty');
            $table->decimal('total_amount', 8, 2);
            $table->string('status')->nullable();;
            $table->text('properties')->nullable();;
            $table->text('remarks')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_schedules');
    }
}
