<?php
namespace App\Http\Controllers;

use Segment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class MainController extends Controller {

	public function __construct() {
	}
	
	public function findTestQueries() {
        var_dump('asda');
    }
}
