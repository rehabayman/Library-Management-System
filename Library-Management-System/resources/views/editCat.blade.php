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
        <div class="row justify-content-center" style="margin-top:120px;">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">Edit {{$category->category_name}} Category</div>
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
                        <div>
                            {!! Form::open(['route'=>['category.update',$category->id],'method'=>'put']) !!}
                            {!! Form::text('category',$category->category_name,['class'=>'form-control']) !!}
                            <div style="float: right;">
                                {!! Form::submit('Edit Category',['class'=>'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>