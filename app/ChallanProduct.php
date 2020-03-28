<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallanProduct extends Model
{
    protected $fillable = [
        'challan_id','desc', 'unit', 'order_item_quantity'
    ];

    public function challan()
    {
        return $this->belongsTo(Challan::class);
    }
}
