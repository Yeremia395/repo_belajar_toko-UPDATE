<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\orders;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
	public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'jumlah' => 'required',
    			'bill' => 'required',
    			'id_produk' => 'required'
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}
    	$simpan = Orders::create([
    		'jumlah' => $request->jumlah,
    		'bill' => $request->bill,
    		'id_produk' => $request->id_produk
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
     $data_orders = Orders::join('product', 'product.id_produk', 'orders.id_produk')->get();
     return Response()->json($data_orders);
    }
    
     public function detail($id)
 {
  if (Orders::where('id', $id)->exist()) {
      $data_orders = Orders::join('product', 'product.id_produk', 'orders.id_produk')->where('orders.id', '=', $id)->get();
      return Response()->json($data_orders);
  }
  else{
    return Response()->json(['message' => 'Tidak Ditemukan']);
  }
 }
 public function update ($id, Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'jumlah'=> 'required',
            'bill' => 'required'
    
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah = Orders::where('id',$id)->update([
            'jumlah' => $request->jumlah,
            'bill' => $request->bill,
            'id_produk' => $request->id_produk
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
        $hapus = Orders::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}
