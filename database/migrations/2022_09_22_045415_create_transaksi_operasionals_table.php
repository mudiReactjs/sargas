<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiOperasionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_operasionals', function (Blueprint $table) {
            $table->id();
            $table->integer('master_transaksi_operasional_id');
            $table->integer('price_total');
            $table->text('description');
            $table->enum('payment_method', ['cash', 'transafer']);
            $table->text('bukti_bayar');
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
        Schema::dropIfExists('transaksi_operasionals');
    }
}
