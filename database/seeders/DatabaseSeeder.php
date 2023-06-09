<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $lines = file( public_path('assets/CPdescarga.txt') );
        $count = 0;
        foreach( $lines as $key => $line ) {
            $count++;
            list( 
                $d_codigo, 
                $d_asenta, 
                $d_tipo_asenta,
                $d_mnpio,
                $d_estado,
                $d_ciudad,
                $d_cp,
                $c_estado,
                $c_oficina,
                $c_cp,
                $c_tipo_asenta,
                $c_mnpio,
                $id_asenta_cpcons,
                $d_zona
            ) = explode( '|', \Func::clean4search( $line ) );
            $federal_entity = \App\Models\FederalEntity::firstOrCreate(
                [ 'key' => $c_estado, 'name' => $d_estado ]
            );
            $municipality = \App\Models\Municipality::firstOrCreate(
                [ 'key' => $c_mnpio, 'name' => $d_mnpio ]
            );
            $zip_code = \App\Models\ZipCode::firstOrCreate(
                [ 
                    'zip_code'          => $d_codigo, 
                    'locality'          => $d_ciudad, 
                    'federal_entity_id' => $federal_entity->id,
                    'municipality_id'   => $municipality->id
                ]
            );
            $settlement_type = \App\Models\SettlementType::firstOrCreate(
                [ 'name' => $d_tipo_asenta ]
            );
            $settlement = new \App\Models\Settlement;
            $settlement->zip_code_id        = $zip_code->id;
            $settlement->key                = $id_asenta_cpcons;
            $settlement->name               = $d_asenta;
            $settlement->zone_type          = $d_zona;
            $settlement->settlement_type_id = $settlement_type->id;
            $settlement->save();
        }
    }
}
