<?php

namespace App\Http\Controllers;
use App\Book;
use App\Category;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Session;
class DateSortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Session::get('filtered')){
            $data=Session::get('filtered');
        }
        else
        $data=Session::get('data');

        Session::put('data',$data->sortByDesc("publish_date"));
        return view("listBooks", ["data"=> $data->sortByDesc("publish_date"), 
                                    'categories' => Category::all(),
                                    "RatedBooks" => DB::table('user_rate_books')
                                    ->join('books', 'user_rate_books.book_id', '=', 'books.id')
                                    ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get(),]);
       

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
