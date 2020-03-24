<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxInvoiceProduct extends Model
{
    protected $fillable = [
        'tax_invoice_id','desc', 'hsn_code', 'unit', 'order_item_quantity','order_item_price','order_item_actual_amount','cgst_rate','cgst_amt','sgst_rate','sgst_amt','igst_rate','total_gst_amt'
    ];

    public function tax_invoice()
    {
        return $this->belongsTo(TaxInvoice::class);
    }
}
