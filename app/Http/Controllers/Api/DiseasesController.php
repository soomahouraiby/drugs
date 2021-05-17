<?php

namespace App\Http\Controllers\Api;

use App\Diseases;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiseasesController extends Controller
{
    //
    public function index(){
       return Diseases::get();
    }
}
