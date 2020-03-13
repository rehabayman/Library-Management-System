<?php

namespace App\Http\Controllers;
use App\Category;
use App\Book;
use App\UserRateBooks;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\UserLeaseBooks;
class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view("listBooks", [ "Books" => Book::all(), 
                                 "RatedBooks" => DB::table('user_rate_books')
                                 ->join('books', 'user_rate_books.book_id', '=', 'books.id')
                                 ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get(),
                                 "data"=> Book::all(),'categories' => Category::all()]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("createBook", ['categories' => Category::all()]);
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
            'title' => 'required|max:255',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'num_of_copies' => 'required',
            'category' => 'required',
            'cover' => 'required|file|mimes:png,jpeg,jpg',
        ]);

        $book = new Book();

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->num_of_copies = $request->num_of_copies;
        $book->category_id = $request->category;
        $book->cover = $request->cover->store("public/images");
        $book->cover = explode("/", $book->cover);
        $book->cover = $book->cover[count($book->cover) - 1 ];
        $book->save();

        return redirect()->back()->with('message', 'Book has been added successfully!');
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
    public function edit(Book $book, $id)
    {
        //
        $book = Book::find($id);
        return view("editBook", ["book" => $book, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book,$id)
    {
        
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'num_of_copies' => 'required',
            'category' => 'required',
            'cover' => 'required|file|mimes:png,jpeg,jpg',
        ]);

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->num_of_copies = $request->num_of_copies;
        $book->category_id = $request->category;
        $book->cover = $request->cover->store("public/images");
        $book->cover = explode("/", $book->cover);
        $book->cover = $book->cover[count($book->cover) - 1 ];
        $book->save();

        return redirect()->back()->with('message', 'Book has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, $id)
    {
        //

        $book = Book::find($id);
        $book->delete();
        return redirect()->back()->with('message', 'Book has been deleted successfully!');
    }

    public function search(Request $request)
    {
        // dd($request);
        $searchBy = $request->search_param;
        $searchText = $request->search_text;
        if($searchText === "")
        {
            return view("listBooks", ["data"=> Book::all()]);
        }
        else {
            $books = Book::where($searchBy, 'like', '%'.$searchText.'%')->get();
            return view("listBooks", ["data"=> $books]);
        }
    }
    public function filterByCategory(Request $request){
        $request->validate([
            'category'=>'required',
        ]);
        if($request->category==="all"){
            return redirect("/Book");

        }      
        $category = Category::where('id', $request->category)->first();
        return view("listBooks",['data'=>$category->books,'categories' => Category::all(),"RatedBooks" => DB::table('user_rate_books')
        ->join('books', 'user_rate_books.book_id', '=', 'books.id')
        ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get()]);
    }
    public function leaseBook(Request $request){
     
        $request->validate([
            'book_id' => 'required',
            'number_of_days'=>'required',
                   
        ]);
        $book = Book::find($request->book_id);
        if($book->num_of_copies<1)
        return back()->withErrors(["Book is out of stock"]);
        $leaseBook = new UserLeaseBooks;
        $leaseBook->book_id = $request->book_id;
        $leaseBook->user_id = Auth::user()->id;
        $leaseBook->num_of_days = $request->number_of_days;
        $leaseBook->save();     
        $book=Book::find($request->book_id);
        $num_of_copies=$book->num_of_copies;
        $book->num_of_copies=$num_of_copies-1;
        $book->save();           
        return redirect()->back()->with('message', 'You has leased the book');
    }

}
