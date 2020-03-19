<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background: url('/images/Library\ copy.jpg')no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;" >

<head>
    @extends('layouts.app')
    @section('content')
</head>
<body>
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
            <img src="/storage/images/{{ $book->cover }}" alt="{{ $book->title}}" style="border:solid; width:200px; margin-left:9.5rem; margin-right:8rem;">
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
                <textarea name="comment" cols="100" rows="5" style="resize:none;" class="form-control"></textarea><br>
                <button type="submit" class="btn btn-primary" style="float:right;">Comment</button>
            </form>
        </div>

        <div class="container">
            <h5>Related Books</h5>
            <div class="container d-flex p-2 bd-highlight flex-wrap justify-content-around align-items-stretch">
            @foreach ($relatedBooks as $book)
                <div class="card align-self-stretch" style="width: 18rem;">
                    <img src="/storage/images/{{ $book->cover }}" style="height:300px;" class="card-img-top" alt="{{$book->description}}">
                    
                    <div class="card-body">
                        <h3 class="card-title">{{$book->title}}</h3>
                        @if($book->total_rating > 0 )
                            Total rating: {{$book->total_rating}}
                        @endif
                        <p class="card-text">Description: {{$book->description}}</p>
                        <p class="card-tex">Category: {{$book->category->category_name}}</p>
                        <p class="card-tex">Price: {{$book->price}}</p>
                        @if ($book->num_of_copies < 1)
                            <p class="card-tex">Number Of Copies: 0</p>
                        @else
                            <p class="card-tex">Number Of Copies: {{$book->num_of_copies}}</p>
                        @endif
                        <div class="container d-flex p-2 bd-highlight justify-content-around align-items-stretch">
                            <a class="btn btn-success" href="{{route('comment.bookComments' , $book->id)}}">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

        <div class="container">
            <h5>Comments</h5>
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
</body>
</html>
