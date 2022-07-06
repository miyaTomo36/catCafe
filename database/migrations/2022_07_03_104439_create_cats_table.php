<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            //猫の名前を保存するカラム
            $table->string('name');
            //猫の性別を保存するカラム
            $table->integer('gender');
            //猫種を保存するカラム
            $table->integer('type');
            //猫の紹介を保存するカラム
            $table->string('introduction');
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
        Schema::dropIfExists('cats');
    }
}
