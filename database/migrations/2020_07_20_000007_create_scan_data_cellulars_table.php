<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanDataCellularsTable extends Migration
{
    public function up()
    {
        Schema::create('scan_data_cellulars', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->longText('html');
            $table->longText('html_changed')->nullable();
            $table->datetime('html_changed_datetime')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('package_name')->nullable();
            $table->integer('package_minutes')->nullable();
            $table->integer('package_sms')->nullable();
            $table->integer('package_gb')->nullable();
            $table->integer('package_month')->nullable();
            $table->decimal('package_sim_price', 15, 2)->nullable();
            $table->decimal('package_sim_connection_price', 15, 2)->nullable();
            $table->integer('package_min_lines')->nullable();
            $table->decimal('package_change_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
