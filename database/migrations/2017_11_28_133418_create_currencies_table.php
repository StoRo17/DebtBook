<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency', 3)->unique();
        });

        Schema::table('debts', function (Blueprint $table) {
            $table->foreign('currency_id')->references('id')->on('currencies');
        });

        DB::table('currencies')->insert([
            ['currency' => 'RUB'],
            ['currency' => 'USD'],
            ['currency' => 'EUR'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
