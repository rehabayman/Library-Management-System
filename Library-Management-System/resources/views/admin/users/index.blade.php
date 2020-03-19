<!DOCTYPE html>
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
                <div class="card-header">Users</div>
                <div class="card-body">
                    <div class="table-content wnro__table table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <!-- <th scope="col">ID</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Profile Picture</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user) 
                                <tr>
                                    <!-- <th scope="row">{{$user->id}}</th> -->
                                    <td>{{$user->name}}</td>
                                    <td><img src="{{ URL::to('/') }}/images/{{ $user->profile_pic }}" style="height:120px;"></td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->role}}</td>
                                    <td> @if($user->active == 1) <span class="active">active</span> <style>.active{
                                        color:green;
                                    } </style> @else <span class="inactive">inactive</span> <style>.inactive{
                                        color:red;
                                    } </style> @endif</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left" style="margin-left:0.3rem;">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <form action="{{ route('admin.users.handleActiveStatus', $user) }}" method="POST" class="float-left" style="margin-left:0.3rem;">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            @if($user->role == "user")
                                            <button type="submit" class="btn btn-info"> @if($user->active == 1) Deactivate @else Activate @endif</button>
                                            @endif
                                        </form>
                                    </td>
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
@endsection
</body>
</html>