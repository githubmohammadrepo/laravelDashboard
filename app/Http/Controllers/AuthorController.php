<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return view('author.author',compact('authors'));
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
       $validatedData = $request->validate([
            'fullName' => 'required|string|max:60',
            'about'=> 'nullable|string|max:255',
            'city' => 'nullable|string|max:30',
            'phone' => 'nullable|numeric|digits_between:1,15',
            'email' => 'nullable|string|email|max:50',
            'website' => 'nullable|string|url|max:60',
            'publisher' => 'nullable|string|max:50',
            'age' => 'nullable|integer|digits_between:1,3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

           //uplaod new image
        $imageName=null;
        if($request->file('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('authors'), $imageName);
        }


        //update information current authenticated user in database
        $author = new Author();
        $author->fullName = $validatedData['fullName'];
        $author->about = $validatedData['about'];
        $author->city = $validatedData['city'];
        $author->phone = $validatedData['phone'];
        $author->email = $validatedData['email'];
        $author->website = $validatedData['website'];
        $author->publisher = $validatedData['publisher'];
        $author->age = $validatedData['age'];
        $author->image = $validatedData['image'];
        $author->save();

        return back()
            ->with('success','You have successfully upload image.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
