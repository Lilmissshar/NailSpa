<?php

namespace App\Http\Controllers\Admin;

use App\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PromoCodeServices;

class PromoCodesController extends Controller{

	protected $path = 'admin.promoCodes.';
	protected $PromoCodeServices;

	public function __construct(PromoCodeServices $promoCodeServices){
		$this->promoCodeServices = $promoCodeServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			return $this->promoCodeServices->all($request);
		}
		return view($this->path . 'index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
		return view($this->path . 'create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
		$this->validate($request, [
			"code" => "required",
      "used" => "required"
		]);

		$promoCode = new PromoCode();
		$promoCode->code = $request->code;
		$promoCode->used = $request->used;
		$promoCode->save();

		return redirect()->route('admin.promocodes.index');
  }

   public function edit($id){
    $promoCode = Promocode::find($id);

    return view($this->path . 'edit', ['promoCode' => $promoCode]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromoCode $promoCode) {
    return $this->promoCodeServices->update($request, $promoCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $teamMember
   * @return \Illuminate\Http\Response
   */
  public function destroy(Promocode $promoCode){
    $promoCode->delete();

		return success();
  }
}
