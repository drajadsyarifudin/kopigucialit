<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Cart as Cart;

use App\Order;
use App\Product;
use App\Order_detail;
use App\User;
use App\Ongkir;
use GuzzleHttp\Client;
use DB;

use Illuminate\Support\Facades\Auth;

use Validator;

class CartController extends Controller
{
    // public $array_result;
    
    public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }
        
        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Product');
        return redirect('cart')->withSuccessMessage('Item was added to your cart!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validation on max quantity
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

         if ($validator->fails()) {
            session()->flash('error_message', 'Quantity must be between 1 and 5.');
            return response()->json(['success' => false]);
         }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');

        return response()->json(['success' => true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cart')->withSuccessMessage('Item has been removed!');
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function emptyCart()
    {
        Cart::destroy();
        return redirect('cart')->withSuccessMessage('Your cart has been cleared!');
    }

    /**
     * Switch item from shopping cart to wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function custom(){
    
        $data = User::orderBy('created_at','DESC'); 
        $us = Auth::guard('user')->user()->id;
        foreach($data as $r){
            if($r->id == $us){
                // $address=$r->address;
                return $r;
               
            }
        } 
     }

     public function confirmcheckout(){ 
        $r = $this->custom();
        $city_result = $this->getCity();         
        return view('checkout', compact('city_result'));   
     }

     public function generateInvoice(){
        //mengambil data dari table orders
        $order = Order::orderBy('created_at', 'DESC');
        
        //jika sudah terdapat records
        if ($order->count() > 0) {
            //mengambil data pertama yang sdh dishort DESC
            $order = $order->first();
            //explode invoice untuk mendapatkan angkanya
            $explode = explode('-', $order->invoice);
            //angka dari hasil explode di +1
           $int = (int)$explode[1]+1;
           $kode = "INV-";
          $gabung = $kode. $int;
            return $gabung;
        }
        //jika belum terdapat records maka akan me-return INV-1
        return 'INV-1';
    }
   
   
    
    public function storeCheckout(Request $request){
        $client = new Client();
        $result = Cart::content(); 
       $total = str_replace(',', '', $request->total);  
       DB::beginTransaction();
       try{
           $order = Order::create([            
               'invoice' => $this->generateInvoice(),
               
               'user_id' => $request->user_id,
               'total' => $total,
           ]); 
           $ambil = Order::orderBy('created_at', 'DESC');            
               //mengambil data pertama yang sdh dishort DESC
               $pertama = $ambil->first();
               $order_id = $pertama->id;

           foreach($result as $key => $r){          
               Order_detail::create([  
               // $order->order_detail()->create([                       
                   'order_id' =>  $order_id,
                   'product_id' => $r->id,
                   'qty' =>  $r->qty,                          
                   'price' => $r->subtotal,     
               ]);
           }
          
           $item = Product::where('id', '=', $r->id)->first();
           $item->stock = (int)$item->stock - (int)$r->qty;
           $item->save();
           
           $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin='.$request->origin.'&destination='.$request->destination.'&weight='.$request->weight.'&courier='.$request->courier.'',
                    'headers' => [
                        'key' => '156103c8deff7708aa6f11b88db991aa',
                        'content-type'=>'application/x-www-form-urlencoded',
                    ]
                ]
                
            );
            $json = $response->getBody()->getContents();
            $array_result = json_decode($json, true);
            for($k=0; $k < count($array_result['rajaongkir']['results']); $k++){
                for($l=0; $l < count($array_result['rajaongkir']['results'][$k]['costs']); $l++){
                    Ongkir::create([
                        'kurir' => $request->courier,
                        'layanan' => $array_result['rajaongkir']['results'][$k]['costs'][$l]['service'],
                        'tarif' => $array_result['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']
                    ]);
                }
            }
            
            DB::commit();   
           Cart::destroy();
           return redirect()->intended('/payment');
       }catch(\Exception $e){
           DB::rollback();    
           return redirect()->back()->with(['error' => $e->getMessage()]);
       }     
    }




     /* mengambil nama kota dari rajaongkir */
     public function getCity(){
        $client = new Client();
        $client_c = new Client();
        try{
            $response = $client->get('http://api.rajaongkir.com/starter/province',
                array(
                    'headers' => array(
                        'key' => '156103c8deff7708aa6f11b88db991aa',
                    )
                )
            );
            $response_c = $client_c->get('http://api.rajaongkir.com/starter/city',
            array(
                'headers' => array(
                    'key' => '156103c8deff7708aa6f11b88db991aa',
                )
            )
        );
        }catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();
        $json_c = $response_c->getBody()->getContents();

        $prov_result = json_decode($json, true);
        $city_result = json_decode($json_c, true);
        return $city_result;
        
    }
    
}
