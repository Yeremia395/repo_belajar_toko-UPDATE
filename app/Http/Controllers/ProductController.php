<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'nama_produk' => 'required',
    			'tanggal_exp' => 'required',
    			'harga_produk' => 'required'
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}
    	$simpan = Product::create([
    		'nama_produk' => $request->nama_produk,
    		'tanggal_exp' => $request->tanggal_exp,
    		'harga_produk' => $request->harga_produk
    	]);

    	if ($simpan) {
    		return Response()->json(['status'=>1]);
    	}
    	else {
    		return Response()->json(['status'=>0]);
    	}
    }
    public function show()
    {
        return Product::all();
	}
	public function update ($id, Request $request)
    {
        $validator=Validator::make($request->all(),
        [
			
            'nama_produk'=> 'required',
            'harga_produk' => 'required'
    
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah = Orders::where('id',$id)->update([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            
        ]);

        if($ubah){
            return Response()->json(['status'=>1]);
        }
        else{
            return Response()->json(['status'=>0]);
        }

    }
	public function destroy ($id)
    {
        $hapus = Product::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}