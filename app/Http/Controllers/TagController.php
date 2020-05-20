<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id','desc')->paginate(9);
        return view('tag.tag',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $tag = new Tag();
        $tag->name =$validatedData['name'];
        $result = $tag->save();
        //flash message
        if($result){
            //data was successfully saved
            session()->flash('success','tag successfully created!');
        }else{
            //error tag doe`s not crated
            session()->flash('error','tag doe `s not create!');
        }

        //redirect
        return redirect(route('tag.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ]);

        //update data
        $tag->name = $validatedData["name"];
        $result =$tag->save();
        if($result){
            session()->flash('success','tag successfully updated!');

        }else{
            session()->flash('error','tag doe `s not updated!');

        }
        return redirect(route('tag.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $name = $tag->name;
        if($tag->delete()){
            session()->flash('success','tag ('.$name.') successfully deleted!');

        }else{
            session()->flash('error','tag ('.$name.') doe `s no)tdeleted!');

        }

        return redirect(route('tag.index'));

    }
}
