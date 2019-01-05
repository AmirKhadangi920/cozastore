<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\SpecData;
use App\Models\Spec\Spec;

class Product extends Model
{
    protected $table = 'products';

    public $incrementing = false;

    protected $fillable = [
        'id', 'brand_id', 'category_id', 'name', 'code', 'short_description', 'aparat_video',
        'price', 'unit', 'offer', 'colors', 'status', 'photo', 'gallery', 'full_description',
        'keywords', 'advantages', 'disadvantages', 'spec_id'
    ];

    protected $casts = [
        'gallery' => 'array'
    ];

    public static function productCard ($query = null)
    {
        $feilds = ['id', 'name', 'photo', 'label', 'category_id', 'brand_id'];
        if ( auth()->check() )
        {
            $feilds = array_merge( $feilds, ['code', 'status']);
        }
        
        $result = Static::select($feilds)
            ->with([
                'variations:product_id,color_id,warranty_id,price,unit,offer,stock_inventory',
                'variations.color:id,name,value',
                'variations.warranty:id,title,expire',
                'category:id,title',
                'brand:id,title',
            ]);
        
        if ( !auth()->check() )
        {
            $result->where('status', 1);
        }

        if ($query)
            $result->where('name', 'like', '%'.$query.'%');
        
        return $result->latest()->paginate(20);
    }

    public static function productInfo ($product)
    {
        return $product->load([
            // Specification table full relations
            'spec:id',
            'spec.specHeaders:id,spec_id,title,description',
            'spec.specHeaders.specRows:id,spec_header_id,title,label,values,help,multiple',
            'spec.specHeaders.specRows.specData' => function ($query) use ($product) {
                $query->where('product_id', $product->id);
            },
            // Product variations full relations
            'variations',
            'variations.color:id,name,value',
            'variations.warranty:id,title,expire',
            'category:id,title',
            'brand:id,title',
        ]);
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

    public function spec ()
    {
        return $this->belongsTo(Spec::class);
    }

    public function spec_data ()
    {
        return $this->hasMany(SpecData::class);
    }
}
