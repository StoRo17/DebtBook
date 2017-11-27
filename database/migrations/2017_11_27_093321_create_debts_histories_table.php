<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('debt_id')->index();
            $table->foreign('debt_id')->references('id')->on('debts')->onDelete('cascade');
            $table->unsignedDecimal('amount', 10);
            $table->enum('currency', ['dollar', 'euro', 'ruble']);
            $table->enum('type', ['give', 'take']);
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('debts_histories');
    }
}
