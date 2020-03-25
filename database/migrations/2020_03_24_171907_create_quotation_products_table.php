<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quotation_id')->unsigned();
            $table->text('desc');
            $table->string('unit');
            $table->decimal('order_item_quantity');
            $table->decimal('order_item_price');
            $table->decimal('order_item_actual_amount');
            $table->decimal('discount');
            $table->decimal('taxable_amount');
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
        Schema::dropIfExists('quotation_products');
    }
}
