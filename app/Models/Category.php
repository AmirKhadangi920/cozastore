<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent', 'title', 'description'];

    /**
     * Return first level , or cateogries with depth == 1
     *
     * @return Collection
     */
    public static function first_levels()
    {
        return Static::select('id', 'title', 'description')->where('depth', 1)->get();
    }
}
