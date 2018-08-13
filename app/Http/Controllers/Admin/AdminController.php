<?php

namespace Laravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Laravel\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
   	public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
    	return view ('admin.index');
    }

    public function chart(){
	    for ($i=0; $i<12; $i++){
	        $userPerMonth[$i] = User::whereMonth('created_at', date('m',strtotime('-'.$i.' month')))->count();
	    }
	    $userPerMonth = array_reverse($userPerMonth);
	    return view('admin.chart')->with('userPerMonth', $userPerMonth);

    }

   

}
