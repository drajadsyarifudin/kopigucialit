<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
    public function index(){
        $data = DB::table('customers as C')
        ->join('users as U', 'U.id', '=', 'C.user_id')
        ->select('C.id', 'C.name', 'C.address', 'C.phone', 'C.user_id','U.email' )
        ->get();
        $us = Auth::guard('user')->user()->id;
        foreach($data as $r){
            if($r->user_id == $us){
                
                return view('join_table', compact('r'));
            }
            
        }
        
      
    }

}
