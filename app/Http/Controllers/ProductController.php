<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use File;
use Image;


class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(10);
            return view('admin.products.index', compact('products'));
    }

    public function create(){
        $categories = Category::orderBy('name', 'ASC')->get();
            return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request){
        //validasi data
        $this->validate($request, [
            'code' => 'required|string|max:15|unique:products',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'weight' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //default photo kosong
            $photo=null;
            //file photo
            if($request->hasFile('photo')){
                //method save file photo
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            //simpan data ke table
            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);

            //direct ke halaman produk.index
            return redirect(route('admin.produk.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan' ]);
        }catch (\Exception $e){
            //jika aksi gagal kembali ke halaman sebelumnya
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    private function saveFile($name, $photo){
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        
        //simpan gambar ke folder
        $path = public_path('uploads/product');

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


    public function destroy($id){
        //query select id
        $products = Product::findOrfail($id);

        if(!empty($products->photo)){
            File::delete(public_path('uploads/product/'. $products->photo));
        }

        //hapus data table
        $products->delete();

        return redirect()->back()->with(['success' => '<strong>' . $products->name .'</strong> Dihapus']);
    }

    public function edit($id){
        $product = Product::findOrfail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id){
        //validasi
        $this->validate($request, [
            'code' => 'required|string|max:20|exists:products,code',
            'name' => 'required|string|max:25',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'weight' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'image|mimes:jpg,png,jpeg'
        ]);

        try{
            $product = Product::findOrfail($id);
            $photo = $product->photo;

            //cek file dari form
            if ($request->hasFile('photo')) {
                //cek jika photo tidak kosong maka file yang ada di folder akan dihapus
                !empty($photo) ? File::delete(public_path('uploads/product/'. $photo)):null;
                //upload file dengan method saveFile() yang telah dibuat sebelumnya
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            //update dATA DATABASE
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);
            return redirect(route('produk.index'))
                ->with(['success' => '<strong>'. $product->name . '</strong> di Update' ]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    



}
