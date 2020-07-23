<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanProxiesTable extends Migration
{
    public function up()
    {
        Schema::create('scan_proxies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proxy_ip')->unique();
            $table->integer('proxy_port');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
