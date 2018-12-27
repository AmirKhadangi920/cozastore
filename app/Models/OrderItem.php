<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    /**
     * Relation to ProductVariation Model
     *
     * @return ProductVariation Model
     */
    public function variation ()
    {
        return $this->belongsTo(\App\Models\ProductVariation::class);
    }
}
