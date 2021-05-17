<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


}
