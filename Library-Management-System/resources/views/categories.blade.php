@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        @foreach ($errors->all() as $item)
                 <div class="alert alert-danger">
                     {{$item}}    
                </div>  
                @endforeach
                @if(session()->has('message'))
                  <div class="alert alert-success">
                        {{session()->get('message')}}
                    </div>
                @endif
    </div>
        {!! Form::open(['route'=>['category.store'],'method'=>'post']) !!}
            {!! Form::text('category_name') !!}
            {!! Form::submit('Add Category') !!}
            {!! Form::close() !!}
            @foreach ($categories as $category)
            <div>
            <p>{{ $category->category_name }}</p>
            {{-- @if (Auth::user()->can('update', $user)) --}}
                <a href="{{ route('category.edit',[$category->id]) }}">Edit</a>                
            
            {!! Form::open(['route'=>['category.destroy',$category->id],'method'=>'delete']) !!}
            {!! Form::submit('delete',['class'=>'btn btn-danger']); !!}
            {!! Form::close() !!}
            {{-- @endif --}}
            </div>
            @endforeach  
        </div>
        @endsection
        