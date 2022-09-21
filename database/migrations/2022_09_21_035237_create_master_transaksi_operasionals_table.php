<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTransaksiOperasionalsTable extends Migration
{
    /**
     * Database master transaksi operasional
     * code => unique (example code : MTO.001), MTO = Master Transaksi Operasioanl
     * name => string, maks length 100
     * product_id => form product table
     * @return void
     */
    public function up()
    {
        Schema::create('master_transaksi_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->string('name', 100);
            $table->integer('product_id');
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
        Schema::dropIfExists('master_transaksi_operasionals');
    }
}
