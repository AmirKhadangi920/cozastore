<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public $incrementing = false;

    public function color ()
    {
        return $this->belongsTo(Color::class);
    }

    public function warranty ()
    {
        return $this->belongsTo(Warranty::class);
    }
}
