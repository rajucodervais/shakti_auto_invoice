<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
     protected $fillable = [
        'quotation_id','desc', 'unit','order_item_price', 'order_item_quantity','order_item_actual_amount','discount','taxable_amount'
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
