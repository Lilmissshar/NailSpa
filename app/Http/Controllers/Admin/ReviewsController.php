<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ReviewServices;

class ReviewsController extends Controller{

	protected $path = 'admin.reviews.';
	protected $reviewServices;

	public function __construct(ReviewServices $reviewServices){
		$this->reviewServices = $reviewServices;
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request){
		if ($request->isJson()) {
			return $this->reviewServices->all($request);
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
			"user_id" => "required",
      "review" => "required"
		]);

		$review = new Review();
		$review->review = $request->review;
		$review->user_id = $request->user_id;
		$review->save();

		return redirect()->route('admin.reviews.index');
  }

   public function edit(Review $review){
    return view($this->path . 'edit', ['review' => $review]); //'branch' -> variable from the blade, $branch -> define what the variable is the name that is being transferred
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review) {
    return $this->reviewServices->update($request, $review);
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
  public function destroy(Review $review){
    $review->delete();

		return success();
  }
}
