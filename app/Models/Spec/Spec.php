<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    public function specHeaders ()
    {
        return $this->hasMany(SpecHeader::class);
    }
}
