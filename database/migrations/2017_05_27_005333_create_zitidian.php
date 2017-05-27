<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZitidian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zitidian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address',255)->comment('地址');
            $table->string('phone',15)->comment('电话');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态：1正常，0关闭');
            $table->tinyInteger('del')->default(1)->comment('状态：1正常，0删除');
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
        Schema::dropIfExists('zitidian');
    }
}
