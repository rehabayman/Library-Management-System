{!! Form::open(['route'=>['category.update',$category->id],'method'=>'put']) !!}
{!! Form::text('category',$category->category_name) !!}
{!! Form::submit('Edit Category') !!}
{!! Form::close() !!}