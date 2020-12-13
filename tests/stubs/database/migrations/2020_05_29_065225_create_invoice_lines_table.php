<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLinesTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            $table->integer('description');
            $table->integer('item_amount');
            $table->integer('item_price');
            $table->integer('vat_percentage');
            $table->integer('total_price_excluding_vat');
            $table->integer('total_price_including_vat');

            $table->timestamps();
        });
    }
}
