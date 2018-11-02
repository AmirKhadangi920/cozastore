<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'images';

    protected $fillable = ['name', 'description', 'photo'];
}
