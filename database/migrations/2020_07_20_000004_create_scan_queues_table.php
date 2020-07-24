<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanQueuesTable extends Migration
{
    public function up()
    {
        Schema::create('scan_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scan_url');
            $table->string('scan_parameters')->nullable();
            $table->boolean('scan_finished')->default(0)->nullable();
            $table->datetime('scan_datetime')->nullable();
            $table->string('request')->nullable();
            $table->integer('response_code')->nullable();
            $table->longText('response_html')->nullable();
            $table->string('type')->nullable();
            $table->integer('tries')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
