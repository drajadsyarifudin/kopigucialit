<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Customer;
use App\Order;
use App\Order_detail;
use App\Payment;
use App\Shipping;
use Validator;
use DB;

class UserController extends Controller
{
    // public function customer(){
    //     $data = DB::table('customers as C')
    //     ->join('users as U', 'U.id', '=', 'C.user_id')
    //     ->select('C.id', 'C.name', 'C.address', 'C.phone', 'C.user_id','U.email', 'U.password')
    //     ->get();
    //     $us = Auth::guard('user')->user()->id;
    //     foreach($data as $r){
    //         if($r->user_id == $us){
    //             // $address=$r->address;
    //             return $r;
               
    //         }
    //     }   
    // }
    public function index(){
       
        return view('user.index');
    }

    public function edit($id){
        $cust = User::findOrfail($id);
        return view('user.edit', compact('cust'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
           
        ]);
        try{
            // $user = User::findOrfail($request->user_id); 
            $cust = User::findOrfail($id); 
            
            //update user
            // $user->update([
            //     'name' => $request->name,
            //     'email' => $request->email
            // ]);

            $cust->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone
            ]);
            return redirect(url('user/profil'));
        }catch (\Exception $e){
            //jika gagal redirect ke form edit lagi
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        
    }

    public function order(){
        $user = Auth::guard('user')->user()->id;
        $join = DB::table('orders as O')
        ->join('payments as P', 'P.order_id', '=', 'O.id' )
        ->join('shippings as S', 'S.payment_id', '=', 'P.id')
        ->select('O.id','O.invoice','O.user_id','P.total_payment','S.status','S.resi')
        ->where('user_id','=', $user)
        ->get();
        
        return view('user.user_order', compact('join'));
    }

    public function orderDetail($id){
       $det = Order_detail::where('order_id','=',$id)->get();
        return view('user.order_details', compact('det'));
    }







    // public function getOrder(){
    //     $data = Order::orderBy('created_at', 'DESC')->get();
    //     $user = Auth::guard('user')->user()->id;
    //     foreach($data as $order){
    //         if($order->user_id == $user){
    //             return $order;
               
    //         }
    //     }   
    // }
    // public function getPayment(){
    //     $datas = DB::table('payments as P')
    //     ->join('shippings as S', 'S.payment_id', '=', 'P.id')
    //     ->select('P.id','P.order_id','P.item_price_total','S.status','S.resi')
    //     ->get();
    //     $order = $this->getOrder();
    //     $id = $order->id;
    //     foreach($datas as $pay){
    //         if($pay->order_id == $id){
    //             return $pay;
               
    //         }
    //     }   
    // $order = $this->getOrder();
        // $payment = $this->getPayment();
    // }


}
