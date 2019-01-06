<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecRow extends Model
{
    protected $fillable = [
        'title', 'label', 'values', 'help', 'multiple'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    public function specHeader ()
    {
        return $this->belongsTo(SpecHeader::class, 'spec_header_id');
    }

    public function specData ()
    {
        return $this->hasOne(SpecData::class, 'spec_row_id');
    }

    public function specDatas ()
    {
        return $this->hasMany(SpecData::class, 'spec_row_id');
    }
}
