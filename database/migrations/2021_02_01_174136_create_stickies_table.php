<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStickiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickies', function (Blueprint $table) {
            $table->id();
            $table->integer('sticky_object_id');  //目标id
            $table->string('sticky_object')->default('carpool');  //置顶类型，post carpool
            $table->integer('minutes');  //置顶时长 单位分钟
            $table->integer('cost_fee');  //费用
            $table->integer('admin_user_id')->default(0);  //管理员后台操作时记录
            $table->string('status')->default('pending'); //状态
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('stickies');
    }
}
