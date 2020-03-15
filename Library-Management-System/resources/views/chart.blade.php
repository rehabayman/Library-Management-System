@extends('layouts.app')

@section('content')
   <div>

        <div style="width: 60%;margin: 0 auto;">

            {!! $chart->container() !!}

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

        {!! $chart->script() !!}

    </div>
@endsection
