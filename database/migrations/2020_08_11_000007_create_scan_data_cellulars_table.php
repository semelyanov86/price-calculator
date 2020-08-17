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
            $table->datetime('html_changed_datetime')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('package_name')->nullable();
            $table->decimal('package_change_price', 15, 2)->nullable();
            $table->string('parser')->unique();
            $table->decimal('package_month_price', 15, 2)->nullable();
            $table->boolean('html_changed')->default(0)->nullable();
            $table->integer('package_min_lines')->nullable();
            $table->integer('package_minutes')->nullable();
            $table->integer('package_sms')->nullable();
            $table->integer('package_gb')->nullable();
            $table->decimal('package_sim_price', 15, 2)->nullable();
            $table->decimal('package_sim_connection_price', 15, 2)->nullable();
            $table->integer('minutes_to_other_countries')->nullable();
            $table->string('logo')->nullable();
            $table->longText('other_details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
