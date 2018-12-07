<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public $incrementing = false;

    protected $fillable = [
        'pro_id', 'category', 'name', 'code', 'short_description', 'aparat_video',
        'price', 'unit', 'offer', 'colors', 'status', 'full_description',
        'keywords', 'advantages', 'disadvantages'
    ];

    // public function setOfferAttribute($value)
    // {
    //     $this->attributes['offer'] = ($value == null)? 0 : $value;
    // }

    
    // public function setStockInventoryAttribute($value)
    // {
    //     $this->attributes['stock_inventory'] = ($value == null)? 0 : $value;
    // }


}
