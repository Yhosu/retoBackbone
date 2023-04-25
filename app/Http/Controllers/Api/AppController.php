<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Http\Requests;
use App\Http\Controllers\Controller\Api;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Rules\VerifyExistModel;
use App\Rules\VerifyExistClientInGeofence;
use App\Imports\MassiveInvoicesImport;


class AppController {

    public function __construct() {
	}

    public function apiGetZipCode( $code ) {
        $zip_code = \App\Models\ZipCode::where( 'zip_code', $code )->firstOrFail();
        return response()->json( $zip_code, 200 );
    }
}