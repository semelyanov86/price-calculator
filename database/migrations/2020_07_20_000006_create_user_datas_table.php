<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDatasTable extends Migration
{
    public function up()
    {
        Schema::create('user_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->longText('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
