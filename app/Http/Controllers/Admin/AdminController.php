<?php

namespace Laravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;

class AdminController extends Controller
{
   	public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
    	return view ('admin.index');
    }
    	
}
