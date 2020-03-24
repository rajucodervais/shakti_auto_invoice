<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_invoice_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tax_invoice_id')->unsigned();
            $table->text('desc');
            $table->string('hsn_code');
            $table->string('unit');
            $table->decimal('order_item_quantity');
            $table->decimal('order_item_price');
            $table->decimal('order_item_actual_amount');
            $table->decimal('cgst_rate');
            $table->decimal('cgst_amt');
            $table->decimal('sgst_rate');
            $table->decimal('sgst_amt');
            $table->decimal('igst_rate');
            $table->decimal('total_gst_amt');
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
        Schema::dropIfExists('tax_invoice_products');
    }
}
