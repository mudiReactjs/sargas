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
            $table->integer('fishermen_id');
            $table->integer('product_id');
            $table->integer('location_id');
            $table->integer('qty');
            $table->integer('total');
            $table->enum('payment_method', ['belum-bayar','transfer', 'cash']);
            $table->text('receipt');
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
