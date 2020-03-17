<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @extends('layouts.app')
    @section('content')
</head>
<body>
<div class="container">

{!! Form::open(['route'=>['category.update',$category->id],'method'=>'put']) !!}
{!! Form::text('category',$category->category_name) !!}
{!! Form::submit('Edit Category') !!}
{!! Form::close() !!}


</div>
</body>
</html>