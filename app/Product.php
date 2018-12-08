<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\SpecData;

class Product extends Model
{
    protected $table = 'products';

    public $incrementing = false;

    protected $fillable = [
        'pro_id', 'category', 'name', 'code', 'short_description', 'aparat_video',
        'price', 'unit', 'offer', 'colors', 'status', 'full_description',
        'keywords', 'advantages', 'disadvantages'
    ];

    public static function productCard ()
    {
        return Static::select('id', 'name', 'photo', 'label', 'category_id', 'brand_id')
                    ->with([
                        'variations:product_id,price,color_id,warranty_id',
                        'variations.color:id,name,value',
                        'variations.warranty:id,title,expire',
                        'category:id,title',
                        'brand:id,title',
                    ])
                    ->where('status', 1)
                    ->latest()
                    ->paginate(20);
    }

    public static function productInfo ($id)
    {
        return Static::select(
                        'id', 'name', 'photo', 'label', 'category_id', 'brand_id',
                        'short_description', 'aparat_video', 'full_description', 'keywords',
                        'advantages', 'disadvantages'
                    )->with([
                        'spec_data:id,spec_row_id,data,product_id',
                        'spec_data.specRow:id,spec_header_id,title,label,values',
                        
                        'variations:product_id,price,color_id,warranty_id',
                        'variations.color:id,name,value',
                        'variations.warranty:id,title,expire',
                        'category:id,title',
                        'brand:id,title',
                    ])->where('status', 1)->findOrFail($id);
    }

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function parentCategory ()
    {
        return $this->belongsTo(Category::class, 'parent_category');
    }

    public function variations ()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function brand ()
    {
        return $this->belongsTo(Brand::class);
    }

    public function spec_data ()
    {
        return $this->hasMany(SpecData::class);
    }
}
