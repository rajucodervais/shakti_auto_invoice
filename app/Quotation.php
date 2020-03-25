<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'name','city','state_name','zip_code','state_code','address','date','sub_total','total_taxable_value','cgst','sgst', 'igst', 'grand_total'
    ];

    public function quotation_products()
    {
        return $this->hasMany(QuotationProduct::class);
    }
}
