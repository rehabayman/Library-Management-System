<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use App\UserRateBooks;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\UserLeaseBooks;
use App\Charts\ProfitChart;
use App\UserFavoriteBooks;
use Session;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        Session::put("data",Book::all());
        Session::put("filtered",Book::all());
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
            'publish_date' => 'required|date',
            'profit_precentage' => 'required|numeric|between:0,0.70'
        ]);

        $book = new Book();

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->profit_precentage = $request->profit_precentage;
        $book->num_of_copies = $request->num_of_copies;
        $book->category_id = $request->category;
        $book->publish_date = $request->publish_date;
        $book->cover = $request->cover->store("public/images");
        $book->cover = explode("/", $book->cover);
        $book->cover = $book->cover[count($book->cover) - 1];
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
    public function update(Request $request, Book $book, $id)
    {

        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'num_of_copies' => 'required',
            'category' => 'required',
            'cover' => 'required|file|mimes:png,jpeg,jpg',
            'publish_date' => 'required|date',
            'profit_precentage' => 'required|numeric|between:0,0.70'
        ]);

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->profit_precentage = $request->profit_precentage;
        $book->num_of_copies = $request->num_of_copies;
        $book->category_id = $request->category;
        $book->publish_date = $request->publish_date;
        $book->cover = $request->cover->store("public/images");
        $book->cover = explode("/", $book->cover);
        $book->cover = $book->cover[count($book->cover) - 1];
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
        $book = Book::find($id);
        $book->delete();
        return redirect()->back()->with('message', 'Book has been deleted successfully!');
    }

    public function search(Request $request)
    {
        $GLOBALS['searchBy'] = $request->search_param;
        $GLOBALS['searchText'] = $request->search_text;
        if($GLOBALS['searchText'] === "")
        {
           
            return view("listBooks", ["data"=> Book::all(), 'categories' => Category::all(), "RatedBooks" => DB::table('user_rate_books')
            ->join('books', 'user_rate_books.book_id', '=', 'books.id')
            ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get()]);
        }
        else {
            $books = Session::get('filtered')->filter(function ($value, $key) {         
                if($GLOBALS['searchText']==="author")  {     
                    if (strpos($value->author,$GLOBALS['searchText']) !== false) {
                        return $value;
                    }
                }
                else 
                    if (strpos($value->title,$GLOBALS['searchText']) !== false) {
                        return $value;
                    }
            });
            
            // $books = Book::where($searchBy, 'like', '%'.$searchText.'%')->get();
            Session::put("data",$books);
            Session::put("filtered",$books);
            return view("listBooks", ["data"=> $books, 'categories' => Category::all(), "RatedBooks" => DB::table('user_rate_books')
            ->join('books', 'user_rate_books.book_id', '=', 'books.id')
            ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get()]);
        }
    }

    public function filterByCategory(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);
        // $category = Category::where('id', $request->category)->first();
       
        if($request->category==="all"){
            Session::put("filtered",Session::get('data'));
            return view("listBooks",['data'=>Session::get('data'),'categories' => Category::all(),"RatedBooks" => DB::table('user_rate_books')
            ->join('books', 'user_rate_books.book_id', '=', 'books.id')
            ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get()]);

        }     
        $GLOBALS['category']=$request->category;
        $filtered = Session::get("data")->filter(function ($value, $key) {
           return $value->category_id == $GLOBALS['category'];
        });     
        Session::put("filtered",$filtered);
        return view("listBooks",['data'=>$filtered,'categories' => Category::all(),"RatedBooks" => DB::table('user_rate_books')
        ->join('books', 'user_rate_books.book_id', '=', 'books.id')
        ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get()]);
    }
    public function leaseBook(Request $request)
    {

        $request->validate([
            'book_id' => 'required',
            'number_of_days' => 'required',

        ]);
        $book = Book::find($request->book_id);
        if ($book->num_of_copies < 1)
            return back()->withErrors(["Book is out of stock"]);
        $leaseBook = new UserLeaseBooks;
        $leaseBook->book_id = $request->book_id;
        $leaseBook->user_id = Auth::user()->id;
        $leaseBook->num_of_days = $request->number_of_days;
        $leaseBook->save();
        $book = Book::find($request->book_id);
        $num_of_copies = $book->num_of_copies;
        $book->num_of_copies = $num_of_copies - 1;
        $book->save();
        return redirect()->back()->with('message', 'You have leased the book');
    }

    public function favouriteBook(Request $request)
    {

        $favouriteBook = new UserFavoriteBooks;
        $favouriteBook->user_id = Auth::id();
        $favouriteBook->book_id = $request->book_id;
        $favouriteBook->save();
        return redirect()->back()->with('message', 'You have favourited the book');
    }
    public function unfavouriteBook(Request $request)
    {

        UserFavoriteBooks::where('book_id', $request->book_id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('message', 'You have unfavourited the book');
    }

    public function favourites(){
        Session::put("data",Auth::user()->favoriteBooks()->where('user_favorite_books.deleted_at',null)-> get());
        Session::put("filtered",Session::get('data'));
        return view("listBooks", [ "Books" => Auth::user()->favoriteBooks()->where('user_favorite_books.deleted_at',null)->get(), 
                                 "RatedBooks" => DB::table('user_rate_books')
                                 ->join('books', 'user_rate_books.book_id', '=', 'books.id')
                                 ->join('users', 'user_rate_books.user_id', '=', 'users.id')->get(),
                                 "data"=> Auth::user()->favoriteBooks()->where('user_favorite_books.deleted_at',null)-> get(),'categories' => Category::all()]);
       

    }
    public function profitChart()
    {
        $profits = DB::table('user_lease_books')
        ->join('books', 'user_lease_books.book_id', '=', 'books.id')
        ->selectRaw('books.price * books.profit_precentage * 0.01 *  user_lease_books.num_of_days as total_profit')
        ->get()->pluck('total_profit')->toArray();

        $dates = DB::table('user_lease_books')->selectRaw('(created_at)')
        ->get()->pluck('created_at')->toArray();


        $chart = new ProfitChart;

        $chart->labels($dates);

        $chart->dataset('Profit per day', 'line', $profits)->options([

            'fill' => 'true',

            'borderColor' => '#51C1C0'

        ]);


        return view('chart', compact('chart'));

    }
}
