<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مرجع دانلود زیرنویس فارسی</title>
    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>
<body class="ponishweb">
<!-- Page Content -->
<div>
    <div class="container Ponishweb-ir">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse" role="navigation" style="background-color:#42d2ad">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                     data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">تغییر وضعیت</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('') }}" data-type="home" data-title="خانه">
                        <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="logo">
                    </a>
                </div>
                <!-- /.navbar-header -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        {{-- <li><a href="{{ url('contact') }}">تماس با ما</a></li>--}}
                        <li><a href="{{ url('') }}">صفحه اصلی</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- /.navbar -->
        <div class="row">
            <div class="col-sm-12">
                <!-- Search -->
                <div class="well text-center">
                    {{ Form::open(array('route' => 'search')) }}
                        <div class="form-group">
                            {{ Form::label('title', __('جستجوی زیرنویس فارسی')) }}
                            {{ Form::text('title', '',
                                array('id' => 'title', 'class' => 'form-control input-lg search-query',
                                'placeholder' => 'نام فیلم مورد نظر بدون سال انتشار ...', 'required' => true)) }}
                        </div>
                        {{ Form::submit( __('جستجو') , array('name' => 'submit',
                        'class' => 'btn btn-sm btn-success mt-2')) }}
                     {{ Form::close() }}
                </div>
                <!-- Page breadcrumb -->
                <ol class="breadcrumb">
                    <li><a href="/">خانه</a></li>
                    <li>جستجوی زیرنویس</li>
                    <li class="lefth active">Search Query</li>
                </ol>
                <!-- ADS -->
                @include('layouts.ads')
                 <!-- Contents -->
                @yield('content')
            </div>
        </div> <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<hr class="clearfix"/>
<footer class="container-fluid footer">
    <div class="row">
        <div class="col-lg-12" style="text-align:center;padding-top:10px;">
            <p>تمامی حقوق نزد این سایت محفوظ می باشد.</p>
        </div>
    </div>
</footer>
<!-- Scripts -->
<script src="{{ asset('assets/js/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>