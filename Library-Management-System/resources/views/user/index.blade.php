<!doctype html>
<html style="background: url('/images/Library\ copy.jpg')no-repeat center center fixed; 
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@extends('layouts.app')
@section('content')
</head>
<body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit profile') }}</div>
                        @if ($errors->any())
                        
                            @foreach ($errors->all() as $error)
                            <h4>{{$error}}</h4>
                            @endforeach
                        @endif
                        @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                        <div class="card-body">                          
                            <form action="{{url('profile')."/".Auth::user()->id}}" method="post" enctype="multipart/form-data"
                                >
                                @csrf
                                {{ method_field('put')}}
                            <div class="form-group row">                          
                                {{ Form::label('username',null,['class'=>'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                {{ Form::text('username',$profile->username,['class'=>'form-control']) }}
                                </div>
                            </div>
                                <div class="form-group row">                          
                                {{ Form::label('phone', 'phone',['class'=>'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                {{ Form::text('phone',$profile->phone,['class'=>'form-control']) }}
                                </div>
                            </div>
                                <div class="form-group row">                          
                                {{ Form::label('name', 'name',['class'=>'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                {{ Form::text('name',$profile->name,['class'=>'form-control']) }} 
                                </div>
                            </div>
                                <div class="form-group row">                          
                                {{ Form::label('profile_pic',null,['class'=>'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                {{ Form::file('profile_pic') }}
                                </div> 
                                </div>
                                <div class="form-group row">                          
                                {{ Form::label('email', "email",['class'=>'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                {{ Form::email('email',$profile->email,['class'=>'form-control']) }} 
                                </div>
                            </div>
                                <div class="form-group row">                          
                                {{ Form::label('New_password',null,['class'=>'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                {{ Form::password('New_Password',['class'=>'form-control']) }} 
                                </div>    
                            </div>
                                <div class="form-group row">                          
                                {{ Form::label('New_Password_confirmation',null,['class'=>'col-md-4 col-form-label text-md-right']) }}
                                <div class="col-md-6">
                                {{ Form::password('New_Password_confirmation',['class'=>'form-control']) }} 
                                </div>    
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                            {{ Form::submit('submit',['class'=>'btn btn-primary'])}}
                            </div>
                            </div>
                            {{ Form::close() }}
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection

    </body>
</html>