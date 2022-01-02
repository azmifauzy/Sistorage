<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->foreignId('statusBox_id');
            $table->string('sender');
            $table->string('receiver');
            $table->string('address');
            $table->string('telepon');
            $table->foreignId('report_id')->nullable();
            $table->integer('date_sent')->nullable();
            $table->integer('subtotal');
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
        Schema::dropIfExists('boxes');
    }
}
