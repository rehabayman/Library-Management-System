<?php

namespace App\Http\Controllers;

use App\UserCommentedonBooks;
use Illuminate\Http\Request;
use App\Book;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        $request->validate([
            'comment' => 'required|max:191',
        ]);

        $comment = new UserCommentedonBooks();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->book_id = $request->book_id;
        $comment->save();

        $book = Book::where('id', $request->book_id)->first();
        $comments = $book->comments;
        $usersData = array();
        foreach ($comments as $comment) { 
            $user = User::where('id', $comment->user_id)->first(); 
            $usersData[$comment->id] = $user;
        }

        $relatedBooks = Book::where([
            ['category_id', $book->category_id],
            ['id', '<>', $book->id]
            ])->paginate(5);

        return view('comment.bookcomments', ["book"=> $book, 'comments' => $comments, 'users' => $usersData, 'relatedBooks' => $relatedBooks]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCommentedonBooks  $userCommentedOnBook
     * @return \Illuminate\Http\Response
     */
    public function show(UserCommentedonBooks $userCommentedOnBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCommentedonBooks  $userCommentedOnBook
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCommentedonBooks $userCommentedOnBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCommentedonBooks  $userCommentedOnBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCommentedonBooks $userCommentedOnBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCommentedonBooks  $userCommentedOnBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCommentedonBooks $comment)
    {
        $comment->delete();
        $book = Book::where('id', $comment->book_id)->first();
        $comments = $book->comments;
        $usersData = array();
        foreach ($comments as $comment) { 
            $user = User::where('id', $comment->user_id)->first(); 
            $usersData[$comment->id] = $user;
        }
        
        $relatedBooks = Book::where([
            ['category_id', $book->category_id],
            ['id', '<>', $book->id]
            ])->paginate(5);

        return \redirect()->route('comment.bookComments', ["book"=> $book, 'comments' => $comments, 'users' => $usersData, 'relatedBooks' => $relatedBooks]);
    }

    public function bookComments(Request $request, Book $book)
    {
        $comments = $book->comments;
        $usersData = array();
        foreach ($comments as $comment) { 
            $user = User::where('id', $comment->user_id)->first(); 
            $usersData[$comment->id] = $user;
        }
        
        $relatedBooks = Book::where([
            ['category_id', $book->category_id],
            ['id', '<>', $book->id]
            ])->paginate(5);

        return view('comment.bookcomments', ["book"=> $book, 'comments' => $comments, 'users' => $usersData, 'relatedBooks' => $relatedBooks]);
    }
}
