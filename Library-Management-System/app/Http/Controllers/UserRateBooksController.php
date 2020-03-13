<?php

namespace App\Http\Controllers;

use App\UserRateBooks;
use Illuminate\Http\Request;

use App\Book;

class UserRateBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //

        $userRate = new UserRateBooks();
        $userRate->user_id = $request->userId;
        $userRate->book_id = $request->bookId;
        $userRate->rating = $request->rate;

        $userRate->save();

        $book = Book::find($request->bookId);
        $book->total_rating = UserRateBooks::where("book_id", $request->bookId)->avg('rating');
        
        $book->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRateBook  $userRateBook
     * @return \Illuminate\Http\Response
     */
    public function show(UserRateBook $userRateBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRateBook  $userRateBook
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRateBook $userRateBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRateBook  $userRateBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRateBook $userRateBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRateBook  $userRateBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRateBook $userRateBook)
    {
        //
    }
}
