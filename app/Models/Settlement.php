<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settlement extends Model {
	
    protected $table   = 'settlements';
    protected $with    = [ 'settlement_type' ];
    protected $hidden  = [ 'id', 'created_at', 'updated_at', 'settlement_type_id', 'zip_code_id' ];
    public $timestamps = true;

    public function settlement_type() {
        return $this->hasOne(SettlementType::class, 'id', 'settlement_type_id');
    }
}