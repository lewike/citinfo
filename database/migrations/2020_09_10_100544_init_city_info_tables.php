<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitCityInfoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('m_id');
            $table->string('name');
            $table->string('ename')->nullable();
            $table->text('desc');
            $table->string('path');
            $table->integer('p_id');
            $table->integer('depth');
            $table->integer('weight')->default(0);
            $table->integer('highlight')->default(0);
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->default(0);
            $table->string('weixin_id')->nullable()->default('');
            $table->string('category_path');
            $table->string('title')->nullable();
            $table->text('content');
            $table->string('images', 1024)->nullable();
            $table->char('phone', 11);
            $table->char('ip', 15);
            $table->string('contact')->nullable();
            $table->string('phone_local')->nullable();
            $table->string('password');
            $table->string('status')->default('pending');
            $table->integer('expired_day')->default(7);
            $table->integer('index_stick')->default(0);
            $table->integer('category_stick')->default(0);
            $table->integer('views')->default(0);
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('refresh_at')->nullable();
            $table->timestamps();
        });

        Schema::create('phone_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('phone', 11)->unique();
            $table->string('local');
            $table->integer('post_cnt')->default(0);
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action');
            $table->string('type');
            $table->string('md5');
            $table->string('path');
            $table->integer('size');
            $table->timestamps();
        });

        Schema::create('post_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id');
            $table->string('type');
            $table->char('ip', 15);
            $table->timestamps();
        });

        Schema::create('love_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->default(0);
            $table->string('nick_name');
            $table->string('avatar');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('images', 1024)->nullable();
            $table->tinyInteger('gender'); //1: 男， 2: 女
            $table->tinyInteger('age');
            $table->tinyInteger('weight'); // 45-100
            $table->smallInteger('height'); // 150-200
            $table->tinyInteger('education'); // 1:中专以下 2:中专 3:大专 4:本科 5:硕士 6:博士 7:博士后
            $table->string('job');
            $table->tinyInteger('marry'); // 1:未婚 2:离异 3:丧偶
            $table->tinyInteger('income')->default(0); // 2:2000以下 4:2000-4000 6:4000-6000 10:6000-10000 20:10000-20000 21:20000以上
            $table->tinyInteger('car')->default(0); //
            $table->tinyInteger('house')->default(0); //
            $table->tinyInteger('demand_min_age');
            $table->tinyInteger('demand_max_age');
            $table->smallInteger('demand_min_height');
            $table->smallInteger('demand_max_height');
            $table->tinyInteger('demand_marry')->default(0);// 0:不限 1:未婚 2:已婚 3:离异 4:丧偶
            $table->text('demand_other');
            $table->text('self_introduction');
            $table->tinyInteger('vip_level')->default(0);
            $table->timestamps();
        });

        Schema::create('adverts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::dropIfExists('categories');
            Schema::dropIfExists('posts');
            Schema::dropIfExists('phone_infos');
            Schema::dropIfExists('post_reports');
            Schema::dropIfExists('files');
            Schema::dropIfExists('love_members');
            Schema::dropIfExists('adverts');
    }
}
