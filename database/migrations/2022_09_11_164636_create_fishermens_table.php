<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishermensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishermens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('no_tlp');
            $table->integer('location_id');
            $table->integer('product_id');
            $table->string('tool')->nullable();
            $table->integer('family_amount')->nullable();
            $table->text('image');
            $table->boolean('status');
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
        Schema::dropIfExists('fishermens');
    }
}
