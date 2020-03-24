<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxInvoice extends Model
{
    protected $fillable = [
        'vendorcode', 'name', 'customergstin','city','state_name','zip_code','state_code','address','date','podate','purchage_order_no','delivery_challan_no','total_invoice_value','total_taxable_value','total_cgst','total_sgst', 'total_igst', 'grand_total'
    ];

    public function tax_invoice_products()
    {
        return $this->hasMany(TaxInvoiceProduct::class);
    }
}
