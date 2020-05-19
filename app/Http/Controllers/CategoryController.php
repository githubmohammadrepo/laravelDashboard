<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(10);
        return view('category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  $roles = \App\Role::all();
        return view('categ.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
       $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories'

        ]);
        //store
        $category = new Category();
        $category->name =$validatedData['name'];
        $result = $category->save();
        //flash message
        if($result){
            //data was successfully saved
            session()->flash('success','category successfully created!');
        }else{
            //error category doe`s not crated
            session()->flash('error','category doe `s not create!');
        }

        //redirect
        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ]);

        //update data
        $category->name = $validatedData["name"];
        $result =$category->save();
        if($result){
            session()->flash('success','category successfully updated!');

        }else{
            session()->flash('error','category doe `s not updated!');

        }
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $name = $category->name;
        if($category->delete()){
            session()->flash('success','category ('.$name.') successfully deleted!');

        }else{
            session()->flash('error','category ('.$name.') doe `s no)tdeleted!');

        }

        return redirect(route('category.index'));

    }
}
