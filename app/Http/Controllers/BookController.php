<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class BookController extends Controller
{
     //show view create new book
     public function newBook(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('books.new',compact('categories','tags'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id','desc')->paginate(9);
        return view('books.book',compact('books'));
    }
 /**
     * Display a listing trashed of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $books = Book::orderBy('id','desc')->onlyTrashed()->paginate(9);
        return view('books.book',compact('books'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books= Book::paginate(9);
        return view('book.book')->withBooks($books);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
