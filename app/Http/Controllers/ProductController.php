<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return view('pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product_name'=>'required',
            'product_description'=>'required|min:3',
            'img_path'=>'required|mimes:jpeg,png,jpg',
            'category_id'=>'required',

        ]);
        $image = $request->file('img_path')->store('public/product');
            $status= $request->has('status');
        Product::create([
            'product_name'=>$request->product_name,
            'product_description'=>$request->product_description,
            'img_path'=>$image,
            'category_id'=>$request->category_id,
            'status'=>$status
        ]);
        return redirect()->route('product.index')->with('success','Product created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id= Crypt::decrypt($id);
        $product = Product::find($id);
        return view('pages.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id=Crypt::decrypt($id);
        $product = Product::find($id);
        $filename = $product->img_path;
        if($request->file('img_path')){
            $image = $request->file('img_path')->store('public/product');
            \Storage::delete($filename);
            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->img_path = $image;
            $product->category_id = $request->category_id;
            $product->status = $request->has('status');
            $product->save();
        }else{
            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->category_id = $request->category_id;
            $product->status = $request->has('status');
            $product->save();
        }

        return redirect()->route('product.index')->with('success','Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $id=Crypt::decrypt($id);
        $product = Product::find($id);
        $filename = $product->img_path;
        $product->delete();
        \Storage::delete($filename);
        return redirect()->route('product.index')->with('success','Product deleted successfully!');
    }
}
