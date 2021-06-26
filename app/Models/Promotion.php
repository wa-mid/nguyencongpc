<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class Promotion extends Model
{

    protected $table = 'promotion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'status', 'published_at', 'expiry_at'
    ];

}
