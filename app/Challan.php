<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    
	protected $fillable = [
        'vendorcode', 'name', 'customergstin','city','state_name','zip_code','state_code','address','date','podate','purchage_order_no','delivery_challan_no','vehicle_no'
    ];

    public function challan_products()
    {
        return $this->hasMany(ChallanProduct::class);
    }
}
