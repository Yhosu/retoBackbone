<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SettlementType extends Model {
	
	protected $table    = 'settlement_types';
    protected $fillable = [ 'name' ];
    protected $hidden   = [ 'id', 'created_at', 'updated_at' ];
    public $timestamps  = true;
}