<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
</body>
</html>
