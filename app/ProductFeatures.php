<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFeatures extends Model
{
    protected $table = 'product_features';

    protected $fillable = ['product', 'feature', 'value'];

    public $timestamps = false;
}
