<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::all();
        return view('auth.dashboard', compact('reviews'));
    }


    public function add(Request $request)
    {
        //dd($request->all());
        $request->validate([

            'star' => 'required',
            'comment' => 'required', // is the name parameter of the form!!!
        ]);

        $star = $request->input('star');
        $product_id = $request->input('product_id');
        $comment = $request->input('comment');


        $product_check = Product::where('id', $product_id)->first();
        if ($product_check) {
            if (!Review::where('user_id', auth()->user()->id)->where('product_id', $product_id)->exists()) {

                // $existing_review = Review::where('user_id', $authUser->id);
                // if ($existing_review) {
                //     $existing_review->star = $star;
                //     $existing_review->comment = $comment;

                //     $existing_review->update();

                Review::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product_id,
                    'stars' => $star,
                    'comment' => $comment
                ]);
            } else {
                return redirect()->back()->with('fail', 'You Can only Review Once!');
            }

            return redirect()->back()->with('success', 'Review Added successfully');
        }
    }

    public function delete(Request $request, Review $review)
    {

        if (auth()->user()->id == $review->user_id) {
            //$review = Review::findOrFail($request->id);
            $review->delete();
            return redirect()->back()
                ->with('success', 'Review Deleted Successfully!');
        } else {
            return redirect()->back()
                ->withErrors(['fail' => 'Your Not Alowed To Delete This Review!']);
        }
    }
}
