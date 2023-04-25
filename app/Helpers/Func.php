<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;

class Func {

    public static function vardump() {
        $arg_list = func_get_args();
        foreach ( $arg_list as $variable ) {
            echo '<pre style="color: #000; background-color: #fff;">';
            echo htmlspecialchars( var_export( $variable, true ) );
            echo '</pre>';
        }
    }

    public static function clean4search( $text, $cleanSpecialData = true ) {
		$a = 'áéíóúüÁÉÍÓÚÜñÑ';
    	$b = 'AEIOUUAEIOUU??';
		return utf8_encode( trim( strtoupper( strtr( $text, utf8_decode( $a ), $b ) ) ) );
  	}
}