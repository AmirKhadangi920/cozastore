<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'categories';

    protected $fillable = ['parent', 'title', 'description'];
}
