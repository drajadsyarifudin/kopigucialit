<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Customer;
use App\Order;
use App\Order_detail;
use App\User;
use App\Payment;
use App\Shipping;
use DB;

class TransaksiController extends Controller
{
    public function index(){
        $data = DB::table('shippings as S')
            ->join('payments as P', 'P.id', '=', 'S.payment_id')
            ->select('S.id','S.payment_id', 'P.total_payment','S.origin', 'S.destination','S.courier','S.status','S.resi')
            ->get(); 
            return view('admin.transaksi.index', compact('data'));
    }

    public function edit($id){
        $ship = Shipping::findOrfail($id);
        return view('admin.transaksi.edit', compact('ship'));
    }

    public function update(Request $request, $id){
        try{
            //select data berdasarkan id shipping
            $ship = Shipping::findOrfail($id);

            //update data
            $ship->update([
                'status' => $request->status,
                'resi' => $request->resi
            ]);
            return redirect(route('transaksi.index'))->with(['success' => 'Pengiriman: '. $ship->resi. 'Ditambahkan']);
        }catch (\Exception $e){
            //jika gagal redirect ke form edit lagi
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
