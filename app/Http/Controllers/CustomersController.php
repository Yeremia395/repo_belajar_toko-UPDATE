<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
     public function store(Request $request)
    {
    	$validator=Validator::make($request->all(),
    		[
    			'nama_customer' => 'required'
    		]
    	);

    	if($validator->fails()){
    		return Response()->json($validator->errors());
    	}
    	$simpan = Customers::create([
    		'nama_customer' => $request->nama_customer
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
        return Customers::all();
	}
	public function update ($id, Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'id_customer'=> 'required',
            'nama_customer' => 'required'
    
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah = Orders::where('id',$id)->update([
            'id_customer' => $request->id_customer,
            'nama_customer' => $request->nama_customer,
        
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
        $hapus = Customers::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}