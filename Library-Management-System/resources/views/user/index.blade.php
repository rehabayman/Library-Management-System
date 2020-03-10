
{{-- name
username
role
phone
profile_pic
email
password --}}
@extends('layouts.app')

@section('content')
<html>
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
                        <div class="card-body">                          
                            <form action="{{url('profile')."/".Auth::user()->id}}" method="post">
                                @csrf
                                {{ method_field('put')}}   
                                <br>                         
                                {{ Form::label('username') }}
                                {{ Form::text('username',$profile->username) }} 
                                <br>
                                {{ Form::label('phone', 'phone') }}
                                {{ Form::text('phone') }} 
                                <br>
                                {{ Form::label('name', 'name') }}
                                {{ Form::text('name',$profile->name) }} 
                                <br>
                                {{ Form::label('profile_picture', "Profile Picture") }}
                                {{ Form::file('profile_picture') }} 
                                <br>
                                {{ Form::label('email', "email") }}
                                {{ Form::email('email',$profile->email) }} 
                                <br>
                                {{ Form::label('New_password',null) }}
                                {{ Form::password('New_Password',null) }} 
                                <br>
                                {{ Form::label('New_Password_confirmation') }}
                                
                                {{ Form::password('New_Password_confirmation') }} 
                                <br>
                            {{ Form::submit('submit')}}
                            {{ Form::close() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
@endsection