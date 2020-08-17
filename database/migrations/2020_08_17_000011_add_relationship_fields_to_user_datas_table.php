<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserDatasTable extends Migration
{
    public function up()
    {
        Schema::table('user_datas', function (Blueprint $table) {
            $table->unsignedInteger('scan_data_cellulars_id')->nullable();
            $table->foreign('scan_data_cellulars_id', 'scan_data_cellulars_fk_2011806')->references('id')->on('scan_data_cellulars');
        });
    }
}
