<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('code_tr')->unique();
            $table->integer('product_id');
            $table->integer('tot_qty');
            $table->integer('tot_payment');
            $table->string('mitra');
            $table->enum('payment_method', ['belum-bayar','transfer', 'cash']);
            $table->text('receipt');
            $table->double('status');
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
        Schema::dropIfExists('purchases');
    }
}
