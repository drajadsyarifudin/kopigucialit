<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Customer;
use App\Order;
use App\Order_detail;
use App\User;
use App\Payment;
use App\Shipping;
use App\Ongkir;
use DB;
use File;
use Image;
use Illuminate\Support\Facades\Auth;
class ShippingController extends Controller{
    
    public function generatePayment()
    {
        //mengambil data dari table orders
        $pay = Payment::orderBy('created_at', 'DESC');
        
        //jika sudah terdapat records
        if ($pay->count() > 0) {
            //mengambil data pertama yang sdh dishort DESC
            $f = $pay->first();
            //explode invoice untuk mendapatkan angkanya
            
            $explode = explode('-', $f->id);
            //angka dari hasil explode di +1
            
           $int = (int)$explode[1]+1;
           
           
           $kode = "PAY-";
           
          $gabung = $kode.$int;
          
            return $gabung;
        }
        //jika belum terdapat records maka akan me-return PAY-1
        return 'PAY-1';
    }

    
   
    public function payment(){
        $ambil = Order::orderBy('created_at', 'DESC');            
        //mengambil data pertama yang sdh dishort DESC
        $order = $ambil->first();

       $ongkir = Ongkir::orderBy('created_at', 'ASC')->get();
        
       
        return view('payment', compact('order', 'ongkir'));

     }

     public function storePayment(Request $request){
       
        DB::beginTransaction();
        
        try{
            //default photo kosong
            // $photo=null;
            //file photo
            // if($request->hasFile('photo')){
                //method save file photo
            //     $photo = $this->saveFile($request->order_id, $request->file('photo'));
            // }
            // $name=null;
            // if($request->hasFile('photo')){
            //     $resorce=$request->file('photo');
            //     $name=$resorce->getClientOriginalName();
            //     $resorce->move(\base_path() ."/public/uploads", $name);
            // } 
            
            $total = 0;
            $total = $request->item_price_total+$request->shipping_cost;
            $payment = Payment::create([
                'id' => $this->generatePayment(),
                'order_id' => (int)$request->order_id,
                'item_price_total' => (int)$request->item_price_total,
                'shipping_cost' => $request->shipping_cost,
                'total_payment' => $total
                
            ]);
            
            
            $pay = Payment::orderBy('created_at', 'DESC');            
            $pertama = $pay->first();
            $payment_id = $pertama->id;

            $shipping = Shipping::create([
                'payment_id' => $payment_id,
                'origin' =>"Lumajang",
                'destination' =>$request->destination,
                'courier' =>$request->courier,
                'status' =>"Proses",
            ]);
            
            DB::commit();
            return redirect()->intended('/confpay');
        }catch(\Exception $e){
            DB::rollback();    
           return redirect()->back()->with(['error' => $e->getMessage()]);
        }
     }

     public function confirmPay(){
        // $pay = Payment::orderBy('created_at', 'DESC');            
        // $p = $pay->first();
        $ambil = Order::orderBy('created_at', 'DESC');  
        $order = $ambil->first();
        return view('confirm_payment', compact('order'));
     }

     public function confpay(){
        $pay = Payment::orderBy('created_at', 'DESC');            
        $p = $pay->first();
        return view('confpay', compact('p'));
     }
    
     public function formPayment($id){
       $payment = Payment::findOrfail($id);
       return view('confirm_payment', compact('payment'));
     }
    
     public function updatePayment(Request $request, $id){

        try{
            $payment = Payment::findOrfail($id);
            
             $name=null;
            if($request->hasFile('photo')){
                $resorce=$request->file('photo');
                $name=$resorce->getClientOriginalName();
                $resorce->move(\base_path() ."/public/uploads", $name);
            } 
            //cek file dari form
            
            //update dATA DATABASE
            $payment->update([
                'rek_adm' => $request->rek_adm,
                'rek_cust' => $request->rek_cust,
                'photo' => $name,
                'ket' => $request->ket,
            ]);
            return redirect()->intended('/user');
        } catch (\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    
   
     private function saveFile($order_id, $photo){
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = str_slug($order_id) . time() . '.' . $photo->getClientOriginalExtension();
        
        //simpan gambar ke folder
        $path = public_path('uploads/bukti');

        //cek jika uploads/product bukan folder
        if (!File::isDirectory($path)){
            //buat folder
            File::makeDirectory($path, 0777, true, true);
        }

        //simpan gambar yang diuplaod ke folrder uploads/produk
        Image::make($photo)->save($path . '/' . $images);
        //mengembalikan nama file yang ditampung divariable $images
        return $images;
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

    public function prosesShipping(Request $request){
        $client = new Client();
        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin='.$request->origin.'&destination='.$request->destination.'&weight='.$request->weight.'&courier='.$request->courier.'',
                    'headers' => [
                        'key' => '156103c8deff7708aa6f11b88db991aa',
                        'content-type'=>'application/x-www-form-urlencoded',
                    ]
                ]
                
            );
        }catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();

        $array_result = json_decode($json, true);

        $origin = $array_result["rajaongkir"]["origin_details"]["city_name"];
        $destination = $array_result["rajaongkir"]["origin_details"]["city_name"];

        dd($array_result);

        return redirect('payment2');
        // return redirect()->back()->with(['array_result'=>$array_result]);
        // print_r($array_result);
        // echo $array_result["rajaongkir"]["results"][0]["costs"][1]["cost"][0]["value"];
       
    }

    public function payment2(){
        $ambil = Order::orderBy('created_at', 'DESC');            
        //mengambil data pertama yang sdh dishort DESC
        $order = $ambil->first();
       
        $cus = $this->custom();
       
        return view('payment2');
     }
    public function storeCost(Request $request){
        dd($request->radio);

    }

}
