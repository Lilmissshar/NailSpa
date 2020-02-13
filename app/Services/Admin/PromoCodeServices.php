<?php

namespace App\Services\Admin;

use App\PromoCode;
use Illuminate\Http\Request;
use App\Services\TransformerService;

class PromoCodeServices extends TransformerService{

	public function all(Request $request){
		$sort = $request->sort ? $request->sort : 'created_at'; //last parameter is the default
	    $order = $request->order ? $request->order : 'desc';
	    $limit = $request->limit ? $request->limit : 10;
	    $offset = $request->offset ? $request->offset : 0;
	    $query = $request->search ? $request->search : '';

	    $promoCode = PromoCode::where('code', 'like', "%{$query}%")->orderBy($sort, $order);
	    $listCount = $promoCode->count();

	    $promoCode = $promoCode->limit($limit)->offset($offset)->get();

	    return respond(['rows' => $promoCode, 'total' => $listCount]);
	}

	public function update(Request $request, PromoCode $promoCode) {
    $data = $request->validate([
      'code' => 'required',
      'used' => 'required'
    ]);

    $promoCode->code = $data['code']; //the variable museum is what the user wrote? 
    $promoCode->used = $data['used'];
    $promoCode->save();

    return redirect()->route('admin.promocodes.index'); 
  }



	public function transform($promoCode){
		return [
			'code' => $promoCode->code,
			'used' => $promoCode->used
		];
	}
}
