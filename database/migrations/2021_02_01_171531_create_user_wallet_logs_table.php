<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallet_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('type')->default('in'); //in or out
            $table->integer('before_total_amount')->default(0); //记录前总金额
            $table->integer('after_total_amount')->default(0); //记录后总金额
            $table->integer('before_actual_amount')->default(0); //记录前实际金额
            $table->integer('after_actual_amount')->default(0); //记录后实际金额
            $table->integer('before_gift_amount')->default(0); //记录前赠送金额
            $table->integer('after_gift_amount')->default(0); //记录后赠送金额
            $table->morphs('log');
            $table->string('desc')->nullable();
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
        Schema::dropIfExists('user_wallet_logs');
    }
}
