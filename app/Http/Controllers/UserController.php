<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{   
    public $module;

    public function __construct(){
    }

    public function index()
    {
        return view('user');
    }
    public function parent()
    {
        return view('parent');
    }

    
}  
