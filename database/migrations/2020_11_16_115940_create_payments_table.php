<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); //付款订单
            $table->string('order_type')->default('stick');  //付款类型
            $table->string('order_object_type');  //付款目标类型
            $table->bigInteger('order_object_id');  //付款目标类型id
            $table->string('desc');  //付款描述
            $table->string('openid');  //付款人
            $table->string('transaction_id')->nullable();  //交易id
            $table->string('prepay_id')->nullable();  //支付预处理订单id
            $table->string('pay_type')->default('wxpay');  //交易方式，后期支持支付宝
            $table->integer('total_fee');   //付款金额 单位分
            $table->string('status')->default('unpaid'); //状态 unpaid close paid
            $table->timestamp('paid_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
