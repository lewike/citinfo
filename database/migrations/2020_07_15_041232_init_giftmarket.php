<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitGiftmarket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subtitle')->default('');
            $table->string('main_image');
            $table->string('shared_image');
            $table->string('kefu_image');
            
            $table->decimal('price');   //价格
            $table->decimal('commission'); //佣金
            
            $table->integer('count'); //商品数量
            $table->text('merchant'); //商家信息
            $table->text('description');
            $table->integer('buy_count')->default(0); //购买数
            $table->integer('used_count')->default(0); //消费数
            $table->integer('view_count')->default(0); //浏览数
            $table->integer('join_count')->default(0); //参与数
            $table->integer('share_count')->default(0); //分享数

            $table->string('password');
            $table->string('status')->default('draft'); //draft 在编辑 publish 已发布

            $table->timestamp('start_at'); //开始时间
            $table->timestamp('end_at'); //结束时间
            $table->timestamp('expired_at'); //有效时间
            
            $table->timestamps();
        });

        Schema::create('market_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('market_id');
            $table->bigInteger('buy_user_id');
            $table->string('order_no'); //订单号
            
            $table->decimal('price');   //价格
            $table->integer('paid')->default(0);
            $table->timestamp('paid_at')->nullable(); //支付时间
            $table->string('pay_no')->default(''); //支付交易号
            
            $table->integer('used')->default(0);
            $table->timestamp('used_at')->nullable();
            
            $table->decimal('commission')->default(0.0); //佣金
            $table->timestamp('mch_paid_at')->nullable(); //支付时间
            $table->string('mch_pay_no')->default(''); //商户佣金付款号
            $table->bigInteger('share_user_id')->default(0);//推广用户
            
            $table->string('phone')->default(''); //买家电话
            $table->string('status')->default('pending'); //订单状态
            
            $table->timestamps();
        });

        Schema::create('market_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('openid');
            $table->string('avatar')->default('');
            $table->string('nickname')->default('');
            $table->tinyInteger('sex')->default('1'); //1 男 2 女 3 未知
            $table->string('phone')->default('');
            $table->string('local')->default('');
            $table->string('status')->default('normal');
            $table->timestamps();
        });

        Schema::create('market_share_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('market_id'); //活动号
            $table->bigInteger('share_user_id')->default(0); //分享用户
            $table->bigInteger('view_user_id'); //打开用户
            $table->decimal('commission')->default(0.0); //佣金
            $table->timestamp('mch_paid_at')->nullable(); //佣金支付时间
            $table->string('mch_pay_no')->default(''); //商户佣金付款号
            $table->string('ip');
            $table->string('memo'); //备注，佣金可能为0
            $table->timestamps();
        });
    
        Schema::create('market_commission_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('market_id'); //活动号
            $table->string('trade_no');
            $table->string('openid');
            $table->decimal('commission'); //佣金
            $table->timestamp('mch_paid_at'); //佣金支付时间
            $table->string('mch_pay_no'); //商户佣金付款单号
            $table->string('type')->default('buy'); //购买buy 浏览view
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
        Schema::dropIfExists('markets');
        Schema::dropIfExists('market_orders');
        Schema::dropIfExists('market_users');
        Schema::dropIfExists('market_share_views');
    }
}
