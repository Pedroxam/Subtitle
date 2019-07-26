@extends('layouts.app')
@section('content')
    <div class="row">
        <h3 class="text-center text-capa">لیست زیرنویس های {{ $name }}</h3>
        <br/>
        <div class="col-sm-12 text-english text-left bg-white border">
            {!! $result !!}
        </div>
    </div>
@endsection