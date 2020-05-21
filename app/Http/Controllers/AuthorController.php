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
        $authors = Author::orderBy('id','desc')->paginate(10);
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
            'phone' => 'nullable|string',
            'email' => 'nullable|string|email|max:50',
            'website' => 'nullable|string|url|max:60',
            'publisher' => 'nullable|string|max:50',
            'age' => 'nullable|integer|digits_between:1,3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

           //uplaod new image
        $imageName=null;
        if($request->file('image')){
           $imageName = time().'.'.$validatedData['image']->extension();
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
        $author->image = $imageName;
        $result =$author->save();

        $this->redirect_session($result,'Author','created');
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
        return $author;
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
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:60',
            'about'=> 'nullable|string|max:255',
            'city' => 'nullable|string|max:30',
            'phone' => 'nullable|string',
            'email' => 'nullable|string|email|max:50',
            'website' => 'nullable|string|url|max:60',
            'publisher' => 'nullable|string|max:50',
            'age' => 'nullable|integer|digits_between:1,3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

           //uplaod new image
        $imageName=null;
        if($request->file('image')){
            //remvoe old image
            //remove old image
        if(\File::exists(public_path('authors/'.$author->image))){

            //od image removed
            \File::delete(public_path('authors/'.$author->image));

          }else{

            // File does not exists.

          }
           $imageName = time().'.'.$validatedData['image']->extension();
            $request->image->move(public_path('authors'), $imageName);
        }


        //update information current authenticated user in database
        $author->fullName = $validatedData['fullName'];
        $author->about = $validatedData['about'];
        $author->city = $validatedData['city'];
        $author->phone = $validatedData['phone'];
        $author->email = $validatedData['email'];
        $author->website = $validatedData['website'];
        $author->publisher = $validatedData['publisher'];
        $author->age = $validatedData['age'];
        $author->image = $imageName;
        $result =$author->save();

        if($result){
            return back()->with('success','your author successfully created');
        }else{
          return back()->with('error','your author does not created');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        // delete file
        if(\File::exists(public_path('authors/'.$author->image))){

            //od image removed
            \File::delete(public_path('authors/'.$author->image));

          }else{

            // File does not exists.

          }
          if($author->delete()){
              return back()->with('success','your author successfully updated');
          }else{
            return back()->with('error','your author does not updated');

          }

    }
}
