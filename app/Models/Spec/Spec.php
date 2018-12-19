<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Spec extends Model
{
    protected $fillable = [ 'category_id' ];

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function specHeaders ()
    {
        return $this->hasMany(SpecHeader::class);
    }
}
