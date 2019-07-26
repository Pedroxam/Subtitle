@extends('layouts.app')
@section('content')
    <div class="row">
        <h2 class="text-center">نتایج به دست آمده</h2>
        <br/>
        <div class="col-sm-12 text-english text-left bg-white border">
            {!! $result !!}
        </div>
    </div>
@endsection