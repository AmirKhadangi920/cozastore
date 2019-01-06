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

    public static function productCard ($query = null, $options = [])
    {
        $feilds = ['id', 'name', 'photo', 'label', 'category_id', 'brand_id'];
        if ( auth()->check() )
            $feilds = array_merge( $feilds, [ 'code', 'status' ]);

        if ( isset($options['more']) )
            $feilds = array_merge( $feilds, [ 'advantages', 'disadvantages', 'code' ]);
        
        $relations = [
            'variation:id,product_id,color_id,warranty_id,price,unit,offer,offer_deadline,stock_inventory',
            'variation.color:id,name,value',
            'variation.warranty:id,title,expire',
            'category:id,title',
            'brand:id,title',
        ];
        if ( isset($options['orderby']) )
        {
            if ( $options['orderby'] == 'most_expensive' )
            {
                $relations['variation'] = function ($query) {
                    $query->orderBy('price', 'asc');
                };
            }
            elseif ($options['orderby'] == 'cheapest')
            {
                $relations['variation'] = function ($query) {
                    $query->orderBy('price', 'desc');
                };
            }
        }
        $result = Static::select($feilds)->with( $relations );
        
        if ( !auth()->check() )
        {
            $result->where('status', 1);
        }

        if ( isset($options['products']) )
        {
            $result->whereIn('id', $options['products']);
        }

        if ( isset($options['category']) )
        {
            $result->where('category_id', $options['category']);
        }

        if ($query)
            $result->where('name', 'like', '%'.$query.'%');

        if ( isset($options['color']) )
        {
            $result->whereHas('variations', function ($query) use ($options) {
                $query->whereIn('color_id', $options['color']);
            });
        }

        if ( isset($options['price_from']) )
        {
            $result->whereHas('variations', function ($query) use ($options) {
                $query->where('price', '>', $options['price_from'] * 1000);
            });
        }

        if ( isset($options['price_to']) )
        {
            $result->whereHas('variations', function ($query) use ($options) {
                $query->where('price', '<', $options['price_to'] * 1000);
            });
        }
         
        if ( isset($options['brand']) )
            $result->whereIn('brand_id', $options['brand']);
        
        if ( isset($options['orderby']) && $options['orderby'] == 'oldest' )
        {
            return $result->orderBy('created_at', 'desc')->paginate(20);
        }
        if ( !isset($options['orderby']) || isset($options['orderby']) && $options['orderby'] == 'newest' )
        {
            $result->latest();
        } 
        return $result->paginate(20);
    }

    public static function productInfo ($product, $options = [])
    {
        $relations = [
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
        ];
        if ( isset($options['reviews']) )
        {
            $relations[] = 'reviews';
            $relations[] = 'reviews.user:id,first_name,last_name,avatar';
            $relations['reviews'] = function ( $query ) {
                $query->orderBy('created_at', 'desc');
            };
        }
        return $product->load($relations);
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

    public function variation ()
    {
        return $this->hasOne(ProductVariation::class);
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

    public function reviews ()
    {
        return $this->hasMany(Review::class);
    }

    public static function related_products (Product $product)
    {
        return Static::select('id', 'category_id', 'name', 'photo')
            ->with('variation:id,product_id,price,unit,offer,offer_deadline')
            ->where('category_id', $product->category_id)->take(4)->get();
    }
}
