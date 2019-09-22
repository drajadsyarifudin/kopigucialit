<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    // public function __construct(){
    // $this->middleware('auth');
    // }
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request){
        //validasi form
        $this->validate($request, [
                'name'=>'required|string|max:50',
                'description' => 'nullable|string'
                ]);
        try{
            $categories = Category::firstOrcreate([
                'name' => $request->name
            ], [
                'description'=>$request->description
            ]);
            return redirect()->back()->with(['success'=>'Kategori: '. $categories->name. 'Ditambahkan']);             
        }catch (\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }  
    
    public function destroy($id){
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->back()->with(['success' => 'Kategori: '. $categories->name. 'Dihapus']);
    }
    public function edit($id){
        $categories = Category::findOrfail($id);
        return view('admin.categories.edit', compact('categories'));
    }

    public function update(Request $request, $id){
        //validasi form
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try{
            //select data berdasarkan id kategori
            $categories = Category::findOrfail($id);

            //update data
            $categories->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect(route('kategori.index'))->with(['success' => 'Kategori: '. $categories->name. 'Ditambahkan']);
        }catch (\Exception $e){
            //jika gagal redirect ke form edit lagi
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
