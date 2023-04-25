<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZipCode extends Model {
	
	protected $table    = 'zip_codes';
    protected $hidden   = [ 'id', 'created_at', 'updated_at', 'federal_entity_id', 'municipality_id' ];
    protected $fillable = [ 'zip_code', 'locality', 'federal_entity_id', 'municipality_id' ];
    protected $with     = [ 'federal_entity', 'settlements', 'municipality' ];
    public $timestamps  = true;

    public function federal_entity() {
        return $this->hasOne(FederalEntity::class, 'id', 'federal_entity_id');
    }

    public function municipality() {
        return $this->hasOne(Municipality::class, 'id', 'municipality_id');
    }

    public function settlements() {
        return $this->hasMany(Settlement::class, 'zip_code_id', 'id');
    }
}