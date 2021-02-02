<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpools', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('type');
            $table->string('direction_from');
            $table->string('direction_to');
            $table->string('directions')->default('');
            $table->string('car_type')->default('');
            $table->string('car_id')->default('');
            $table->string('additional')->default('');
            $table->string('phone');
            $table->string('description', 512)->default('');
            $table->string('source')->default('');
            $table->string('status')->default('unpaid');
            $table->char('ip', 15);
            $table->integer('publish_fee')->default(0);
            $table->integer('call_cnt')->default(0);
            $table->tinyInteger('seat_cnt')->default(0);
            $table->tinyInteger('sticky')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('sticky_expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carpools');
    }
}
