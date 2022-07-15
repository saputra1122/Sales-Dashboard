<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTarget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_target', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('h_report_target_id');
            $table->string('operating');
            $table->double('target')->nullable(true);
            $table->double('value')->nullable(true);
            $table->integer('position');
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
        Schema::dropIfExists('report_target');
    }
}
