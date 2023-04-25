<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportZipCodes extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-zip-codes {file_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import zip codes.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        $file_id = $this->argument('file_id');
        $lines = file( public_path('assets/CPdescarga' . $file_id . '.txt') );
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
        $this->info('Archivo CPdescarga' . $file_id . ' cargado con éxito');
    }
}