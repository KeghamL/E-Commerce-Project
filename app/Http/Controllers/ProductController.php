<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    //public function __construct()
    //{
    //    $this->middleware('auth')->only(['edit', 'update', 'delete' , 'create']);
    //}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(6);
        $reviews = Review::all();
        return view('auth.dashboard', compact('products', 'reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|digits_between:3,4',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // $data = $request->all();

        $input = $request->all();

        if ($file = $request->file('image')) {
            $destinationPath = 'uploads/products/';
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $input['image'] = "$filename";
        }
        $input['user_id'] = auth()->user()->id;

        Product::create($input);

        return redirect()->route('product-dashboard')
            ->with('success', 'Product Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // Review::where('product_id', $product->id)->get();
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //$product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //$product = Product::findOrFail($id);
        $input = $request->all();

        if ($file = $request->file('image')) {
            $destinationPath = 'uploads/products/';
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $input['image'] = "$filename";
        } else {
            unset($input['image']);
        }

        $input['user_id'] = auth()->user()->id;

        $product->update($input);

        return redirect()->route('product-dashboard')
            ->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //$product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product-dashboard')
            ->with('success', 'Product Deleted Successfully');
    }

    public function search(Request $request)
    {
        $request->validate([
            'find' => 'required',
        ]);
        $search_text = $_GET['find'];
        $products = Product::where('description', 'iLIKE', '%' . $search_text . '%')->get();

        return view('products.search', compact('products'));
    }

    public function livesearch(Request $request)
    {
        $query = $request->get('term', '');
        $products = Product::where('description', 'iLIKE', '%' . $query . '%')->get();

        $data = [];
        foreach ($products as $product) {

            $data[] = [
                'value' => $product->description,
                'id' => $product->id
            ];
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'No Result Found!!', 'id' => ''];
        }
    }
}
