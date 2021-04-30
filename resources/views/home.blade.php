@extends('layouts.app')

@section('content')
    <style>
        #mydiv {
            background-image: url('{{ url('img/background-home.jpeg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 1000px;
            width: 100%;
            margin-top: -50px;
            margin-bottom: -50px;
        }

    </style>
    <div class="container-fluid" id="mydiv">
    </div>
@endsection
