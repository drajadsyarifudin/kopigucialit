<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;

use App\User;
use File;
use Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homeAdmin()
    {
        $product = Product::count();
        $order = Order::count();
        
        $user = User::count();
            return view('admin.home', compact('product', 'order', 'user'));
       
        
    }


}
