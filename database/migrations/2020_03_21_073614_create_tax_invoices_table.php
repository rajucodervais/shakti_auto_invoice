<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendorcode');
            $table->string('name');
            $table->string('customergstin');
            $table->string('city');
            $table->string('state_name');
            $table->bigInteger('zip_code');
            $table->integer('state_code');
            $table->text('address');
            $table->string('date');
            $table->string('podate');
            $table->integer('purchage_order_no');
            $table->integer('delivery_challan_no')->nullable();
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
        Schema::dropIfExists('tax_invoices');
    }
}
