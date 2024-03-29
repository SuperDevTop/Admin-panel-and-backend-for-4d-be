<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('be_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->float('big');
            $table->float('small');
            $table->integer('ticketno');
            $table->integer('total');
            $table->string('number');
            $table->string('company');
            $table->string('roll');
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
        Schema::dropIfExists('be_histories');
    }
};
