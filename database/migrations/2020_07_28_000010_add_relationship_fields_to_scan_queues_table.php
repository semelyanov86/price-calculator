<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToScanQueuesTable extends Migration
{
    public function up()
    {
        Schema::table('scan_queues', function (Blueprint $table) {
            $table->unsignedInteger('proxy_id')->nullable();
            $table->foreign('proxy_id', 'proxy_fk_1863881')->references('id')->on('scan_proxies');
        });
    }
}
