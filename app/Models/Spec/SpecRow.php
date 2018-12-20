<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecRow extends Model
{
    protected $fillable = [
        'title', 'label', 'values', 'min', 'max', 'multiple', 'required'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    public function specHeader ()
    {
        return $this->belongsTo(SpecHeader::class, 'spec_header_id');
    }
}
