<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    //
    public function index(){

        $data = array(
            'login' => array(
                'url'=>  url('api/login'),
                'method' => 'POST',
                'enctype' => 'form-data',
                'access_token' => false,
                'query' => array(
                    'email' => 'required|email',
                    'password' => 'required|min:8',
                ),
                'response' => array(
                    'access_token'=> 'access token',
                    'exprire_in'   => 'The end date of the second token',
                    'Authorization' => 'It is the session that is stored and sent in Request Headers  every time we request the pages to be logged in',
                    'message' => 'Nice message to the user'
                )
             ),

            'register' => array(
                'url'=>  url('api/register'),
                'method' => 'POST',
                'enctype' => 'form-data',
                'access_token' => false,
                'query' => array(
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:app_users',
                    'password' => 'required|string|min:8|confirmed',
                    'password_confirmation' => 'required|string|min:8',
                    'phone' => 'required|min:11|numeric',
                    'age' => 'numeric',
                    'sex' => 'boolean',
                ),
                'response' => array(
                    'access_token'=> 'access token',
                    'exprire_in'   => 'The end date of the second token',
                    'Authorization' => 'It is the session that is stored and sent in Request Headers  every time we request the pages to be logged in',
                    'message' => 'Nice message to the user'
                )
            ),
            'user/info' => array(
                'url'=>  url('user/info'),
                'method' => 'GET',
                'enctype' => 'none',
                'access_token' => true,
                'query' => array(    ),
                'response' => array(
                    'access_token'=> 'access token',
                    'exprire_in'   => 'The end date of the second token',
                    'Authorization' => 'It is the session that is stored and sent in Request Headers  every time we request the pages to be logged in',
                    'message' => 'Nice message to the user'
                )
            )

    );

        return  $data ;
    }
}
