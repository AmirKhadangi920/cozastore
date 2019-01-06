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

    public static function compare ()
    {
        if ( !session('compare_table') || !session('compare') ) return null;

        return Static::find( session('compare_table') )
            ->load([
                'specHeaders:id,spec_id,title,description',
                'specHeaders.specRows:id,spec_header_id,title,label,values,help,multiple',
                'specHeaders.specRows.specDatas' => function ($query) {
                    $query->whereIn('product_id', session( 'compare' ) );
                }
            ]);
    }
}
