<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Customer;
use App\Http\Requests;
use DB;


use Validator;

class AdmuserController extends Controller
{
    public function index(){
        $user = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.user.index', compact('user'));
    }

    public function edit($id){
        $user = User::findOrfail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
           
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);
        try{
            $user = User::findOrfail($id);
            $user->update([
                
                'email' => $request->email,
                'password' => $request->password
            ]);
            return redirect(route('admuser.index'))->with(['success' => 'User: '. $user->name. 'update']);
        }catch(\Exception $e){
            //jika gagal redirect ke form edit lagi
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id){
        $user = User::findOrfail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User: '. $user->name. 'Dihapus']);

    }
}
