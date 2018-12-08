<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecRow extends Model
{
    public function specHeader ()
    {
        return $this->belongsTo(SpecHeader::class, 'spec_header_id');
    }
}
