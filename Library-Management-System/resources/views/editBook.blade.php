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
        <div class="row justify-content-center" style="margin-top:25px;">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">Edit {{$book->title}} Book</div>
                    <div class="card-body" style="padding-buttom:100px;">  
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

    <form method="POST" action="{{route('Book.update', $book->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
            <label>Book's Title</label>
            <input type="text" class="form-control" value="{{$book->title}}" placeholder="Title" name="title">
            </div>

            <div class="form-group">
                <label>Book's Author</label>
                <input type="text" class="form-control" value="{{$book->author}}" placeholder="Enter Author" name="author">
            </div>

            <div class="form-group">
                <label>Book's Description</label>
                <input type="text" class="form-control" value="{{$book->description}}" placeholder="Enter Book" name="description">
            </div>

            <div class="form-group">
                <label>Book's Price</label>
                <input type="number" class="form-control" value="{{$book->price}}" placeholder="Enter Price" min="1" name="price">
            </div>

            <div class="form-group">
                <label>Profit's Percentage</label>
                <input type="number" class="form-control" value="{{$book->profit_precentage}}" placeholder="Enter Profit Percentage" min="0.2" max="0.7" step="0.01" name="profit_precentage">
            </div>

            <div class="form-group">
                <label>Publish Date</label>
                <input type="date" class="form-control" placeholder="Enter Date" name="publish_date" value="{{ $book->publish_date }}">
            </div>

            <div class="form-group">
                <label>Number of copies</label>
                <input type="number" class="form-control" value="{{$book->num_of_copies}}" placeholder="Enter #copies" min="0" name="num_of_copies">
            </div>

            <div class="form-group">
                <label>Book's Category</label>
                <select name="category" class="custom-select">
                    @foreach ($categories as $item)
                        @if($item->id == $book->id)
                            <option value="{{$item->id}}" selected>{{$item->category_name}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Enter book cover</label>
                <input type="file" class="form-control-file" name="cover">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
