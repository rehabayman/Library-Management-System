<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @extends('layouts.app')
    @section('content')
</head>
<body>
<div class="container">
    <div class="row justify-content-center" style="margin-top:120px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>
                <div class="card-body" style="padding-buttom:100px;">
                    <div>
                        @foreach ($errors->all() as $item)
                                 <div class="alert alert-danger">
                                    <li> {{$item}} </li>   
                                </div>  
                                @endforeach
                                @if(session()->has('message'))
                                  <div class="alert alert-success">
                                        {{session()->get('message')}}
                                    </div>
                                @endif
                    </div>
                    {{-- <div class="form-group row">   --}}
                    {!! Form::open(['route'=>['category.store'],'method'=>'post']) !!}
                    <div class="col-md-6" style="display:inline">
                    {!! Form::text('category_name',null,['class'=>'form-control']) !!}
                    </div>
                    <div style="float: right;">
                    {!! Form::submit('Add Category',['class'=>'btn btn-primary']) !!}
                        
                    </div>
                    {!! Form::close() !!}
                    </div>
                    <div class="table-content wnro__table table-responsive" >
                    <table class="table" style="width:40rem;margin:auto;">
                        <thead class="thead-dark">
                            <tr>
                            <!-- <th scope="col">ID</th> -->
                            <th scope="col">Category Name</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    {{-- <!-- <th scope="row">{{$user->id}}</th> --> --}}
                                    <td><h6>{{ $category->category_name }}</h6></td>
                                    <td> <a href="{{ route('category.edit',[$category->id]) }}"><button type="button" class="btn btn-primary" style="float:right;">Edit</button></a>                
                                        {!! Form::open(['route'=>['category.destroy',$category->id],'method'=>'delete']) !!}
                                        {!! Form::submit('delete',['class'=>'btn btn-danger']); !!}
                                        {!! Form::close() !!}
                                        {{-- @endif --}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
