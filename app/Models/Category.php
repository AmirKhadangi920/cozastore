<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\Spec;

class Category extends Model
{
    protected $fillable = ['parent', 'title', 'description', 'avatar'];

    /**
     * Return first level , or cateogries with depth == 1
     *
     * @return Collection
     */
    public static function first_levels()
    {
        return Static::select('id', 'title', 'description', 'avatar')
            ->where('parent', null)->latest()->get();
    }
    
    public function parent_group ()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function products () 
    {
        return $this->hasMany(Product::class);
    }

    public function childs ()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function specs ()
    {
        return $this->hasMany(Spec::class);
    }
}
