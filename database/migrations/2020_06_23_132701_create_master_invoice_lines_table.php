<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_invoice_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->integer('quantity');
            $table->decimal('unit_price',9,2);
            $table->decimal('sub_total',9,2);
            $table->integer('master_id')->unsigned();
            $table->foreign('master_id')->references('id')->on('master_invoices')->onDelete('cascade');
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
        Schema::dropIfExists('master_invoice_lines');
    }
}
