@extends('layouts.app')
@section("content")

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
    </div>
    
    <div>
        <div class="container d-flex p-2 bd-highlight justify-content-left align-items-strech">
            <img src="{{ $book->cover }}" alt="{{ $book->title}}" style="border:solid; width:200px; margin-left:9.5rem; margin-right:8rem;">
            <div>
                <h1>{{ $book->title }}</h1>
                <h2>{{ $book->description }}</h2>
                <h3>{{ $book->total_rating }}</h3>
                <h4>Available Number of Copies: {{ $book->num_of_copies }}</h4>
            </div>
        </div>

        <div class="container d-flex p-2 bd-highlight justify-content-around align-items-left">
            <form action="{{ route('comment.store') }}" method="post">
                @csrf
                <input type="text" name="book_id" value="{{ $book->id }}" hidden>
                <textarea name="comment" cols="100" rows="5" style="resize:none;"></textarea><br>
                <button type="submit" class="btn btn-primary" style="float:right;">Comment</button>
            </form>
        </div>
        <div class="container">
            <h1>Comments</h1>
                @if(count($comments) > 0)
                    @foreach ($comments as $comment)
                    <div class="container" style="margin:2rem;">
                        <h2> {{ $users[$comment->id]->name }} </h2>
                        <h6> {{ $comment->created_at }} </h6>
                        <h3> {{ $comment->comment }} </h3>
                        @can('delete', $comment)
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @endcan
                    </div>
                    @endforeach
                @endif
        </div>
    </div>
@endsection
