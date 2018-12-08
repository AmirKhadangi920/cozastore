<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecData extends Model
{
    protected $table = 'spec_data';

    public function specRow ()
    {
        return $this->belongsTo(SpecRow::class, 'spec_row_id');
    }
}
