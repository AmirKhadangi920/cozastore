<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public $incrementing = false;

    /**
     * Relation to Product model
     *
     * @return Product Model
     */
    public function product ()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relation to Color model
     *
     * @return Color Model
     */
    public function color ()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Relation to Warranty model
     *
     * @return Warranty Model
     */
    public function warranty ()
    {
        return $this->belongsTo(Warranty::class);
    }

    /**
     * Relation to orderItem model
     * 
     * @return OrderItem Model
     */
    
    public function order_item ()
    {
        return $this->hasMany(OrderItem::class, 'variation_id');
    }

    /**
     * return tops product varations
     *
     * @return Collection
     */
    public static function getTops ()
    {
        return static::select('id', 'product_id', 'color_id')
            ->with( [ 'product:id,name', 'color:id,name,value' ] )
            ->withCount('order_item')
            ->orderBy('order_item_count', 'desc')
            ->limit(5)->get();
    }
}
