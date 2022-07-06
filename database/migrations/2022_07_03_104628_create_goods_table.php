<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            //グッズの名称を保存するカラム
            $table->string('name');
            //グッズの価格を保存するカラム
            $table->integer('price');
            //グッズの詳細を保存するカラム
            $table->string('detail');
            //画像のパスを保存するカラム
            $table->string('image_path')->nullable();
            
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
        Schema::dropIfExists('goods');
    }
}
