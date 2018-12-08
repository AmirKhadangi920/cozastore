<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecHeader extends Model
{
    public function specRows ()
    {
        return $this->hasMany(SpecRow::class);
    }

    public function specData()
    {
        return $this->hasMany(SpecData::class);
    }
}
