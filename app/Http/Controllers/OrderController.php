<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Order_detail;
use App\Customer;
use App\User;
use PDF;

class OrderController extends Controller
{
    public function invoicePdf($invoice){
        $order = Order::where('invoice', $invoice)
            ->with('customer', 'order_detail', 'order_detail.product')->first();
        //SET CONFIG PDF MENGGUNAKAN FONT SANS-SERIF
        //DENGAN ME-LOAD VIEW INVOICE.BLADE.PHP
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadView('user.invoice', compact('order'));
        return $pdf->stream();
    }
    
    
    
    
    
    //
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    // public function addOrder(){
    //     $products = Product::orderBy('created_at', 'DESC')->get();
    //     return view('admin.orders.add', compact('products'));
    // }

    // public function getProduct($id){
    //     $products = Product::findOrFail($id);
    //     return response()->json($products, 200);
    // }

    // public function addToCart(Request $request){
    //     //validasi data
    //     //dari ajax request addToCart mengirimkan product_id dan qty
    //     $this->validate($request, [
    //         'product_id' => 'required|exists:products,id',
    //         'qty' => 'required|integer'
    //     ]);

    //     //ambil produk dengan id
    //     $product = Product::findOrFail($request->product_id);
    //     //ambil cookie cart \
    //     $getCart = json_decode($request->cookie('cart'), true);


    //     if($getCart){
    //         //jika key nya exists berdasarkan product_id
    //         if(array_key_exists($request->product_id, $getCart)){
    //             //jumlah qty barang
    //             $getCart[$request->product_id]['qty'] += $request->qty;
    //             //disimpan cookie
    //             return response()->json($getCart, 200)
    //                 ->cookie('cart', json_encode($getCart), 120);
    //         }
    //     }

    //     //cart ksosng, tambah cart baru
    //     $getCart[$request->product_id] = [
    //         'code' => $product->code,
    //         'name' => $product->name,
    //         'price' => $product->price,
    //         'qty' => $request->qty
    //     ];

    //     return response()->json($getCart, 200)
    //         ->cookie('cart', json_encode($getCart), 120);
    // }

    // public function getCart(){
    //     //mengambil dari cookie
    //     $cart = json_decode(reqest()->cookie('cart'), true);
    //     return response()->json($cart, 200);
    // }
    // public function removeCart($id){
    //     $cart = json_decode(request()->cookie('cart'), true);
    //     //hapus cart
    //     unset($cart[$id]);
    //     return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    // }

   

}
