<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'pro_id';

    public $incrementing = false;

    protected $fillable = [
        'id', 'parent', 'name', 'code', 'short_description', 'aparat_video',
        'price', 'unit', 'offer', 'colors', 'status', 'full_description',
        'keywords', 'advantages', 'disadvantages'
    ];
}
