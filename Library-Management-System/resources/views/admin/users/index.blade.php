@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user) 
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->role}}</td>
                                    <td> @if($user->active == 1) active @else inactive @endif</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left" style="margin-left:0.5rem;">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <form action="{{ route('admin.users.handleActiveStatus', $user) }}" method="POST" class="float-left" style="margin-left:0.5rem;">
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
@endsection
