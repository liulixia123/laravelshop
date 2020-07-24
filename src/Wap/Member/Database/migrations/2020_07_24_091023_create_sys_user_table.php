<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('sys_user', function (Blueprint $table) {
              $table->bigIncrements('id');
              $table->string('nick_name', 90);
              $table->char('weixin_openid', 90)->nullable();
              $table->string('image_head', 255);
              $table->timestamps();
          });
    }
    public function down()
    {
        Schema::dropIfExists('sys_user');
    }
}
