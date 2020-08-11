<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanDataCellularUserDataPivotTable extends Migration
{
    public function up()
    {
        Schema::create('scan_data_cellular_user_data', function (Blueprint $table) {
            $table->unsignedInteger('user_data_id');
            $table->foreign('user_data_id', 'user_data_id_fk_1970062')->references('id')->on('user_datas')->onDelete('cascade');
            $table->unsignedInteger('scan_data_cellular_id');
            $table->foreign('scan_data_cellular_id', 'scan_data_cellular_id_fk_1970062')->references('id')->on('scan_data_cellulars')->onDelete('cascade');
        });
    }
}
