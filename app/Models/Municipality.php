<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality extends Model {
	
	protected $table    = 'municipalities';
    protected $fillable = [ 'key', 'name' ];
    protected $hidden   = [ 'id', 'created_at', 'updated_at' ];
    public $timestamps  = true;
}