<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplate2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template2', function (Blueprint $table) {
            $table->id();
            $table->string('operating')->nullable(true);
            $table->double('early_production')->nullable(true);
            $table->double('extrud')->nullable(true);
            $table->double('send')->nullable(true);
            $table->double('before_send')->nullable(true);
            $table->double('before_production')->nullable(true);
            $table->integer('disable')->nullable(true);
            $table->integer('position')->nullable(true);
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
        Schema::dropIfExists('template2');
    }
}
