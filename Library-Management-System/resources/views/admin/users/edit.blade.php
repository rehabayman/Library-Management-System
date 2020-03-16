<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
@extends('layouts.app')

@section('content')
    </head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 style="margin-top:0.5rem;"> Edit User {{$user->name}} </h5>
                </div>
                <!-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif -->
                @if (Session::has("message"))
                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get("message") }}</p>
                @endif
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <!-- <div class="form-group row" id="image-container">

                            <div class="col-md-6">
                                <img src=" {{URL::to('/') }}/images/{{ $user->profile_pic }}" style="height:120px; width:120px;">
                                <button>x</button>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('email') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" readonly>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                            <div class="col-md-6">
                                <input id="profile_pic" type="file" class="@error('profile_pic') is-invalid @enderror" name="profile_pic" value="{{ $user->profile_pic }}">

                                @error('profile_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Promote to Admin?') }}</label>

                            <div class="col-md-1">
                                <input type="text" name="active" value="{{ $user->active }}" hidden>
                                <input type="checkbox" class="form-control @error('role') is-invalid @enderror" id="role" name="role" @if ($user->role === "admin") checked=checked @endif>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5" style="margin-left:20rem;">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>
