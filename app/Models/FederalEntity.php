<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FederalEntity extends Model {
	
	protected $table    = 'federal_entities';
    protected $fillable = [ 'key', 'name', 'code' ];
    protected $hidden   = [ 'id', 'created_at', 'updated_at' ];
    public $timestamps  = true;
}