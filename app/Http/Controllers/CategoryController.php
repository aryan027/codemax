<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =Category::all();
        return view('pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
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
            'category_name'=>'required|unique:categories',
            'category_parent'=>'required',
        ]);
        $status=$request->has('status');
        Category::create([
            'category_name'=>$request->category_name,
            'category_parent'=>$request->category_parent,
            'status'=> $status
        ]);

        return redirect()->route('category.index')->with('success','Category created successfully!');
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
        $category = Category::find($id);
        return view('pages.category.edit',compact('category'));
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
        $this->validate($request,[
            'category_name'=>'required',
            'category_parent'=>'required',
        ]);
        $id=Crypt::decrypt($id);
        $category = Category::find($id);
        $category->category_name= $request->category_name;
        $category->category_parent= $request->category_parent;
        $category->status= $request->has('status');
        $category->save();

        return redirect()->route('category.index')->with('success','Category updated successfully!');
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
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success','Category deleted successfully!');
    }
}
