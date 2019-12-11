<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRkoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rko', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('med_name');  // nama obat
            $table->string('unit');      // jenis satuan obat
            $table->float('price');      // harga satuan
            $table->integer('stock');    // stock sisa
            $table->float('use_avg');    // pemakaian rata-rata
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
        Schema::dropIfExists('rko');
    }
}
