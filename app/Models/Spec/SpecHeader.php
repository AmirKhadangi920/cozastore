<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecHeader extends Model
{
    protected $fillable = [ 'title', 'description' ];

    public function spec ()
    {
        return $this->belongsTo(Spec::class);
    }

    public function specRows ()
    {
        return $this->hasMany(SpecRow::class);
    }

    public function specData()
    {
        return $this->hasMany(SpecData::class);
    }
}
