<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            //ドリンクの名称を保存するカラム
            $table->string('name');
            //ドリンクの値段を保存するカラム
            $table->integer('price');
            //ドリンクの紹介を保存するカラム
            $table->string('feature');
            
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
        Schema::dropIfExists('drinks');
    }
}
