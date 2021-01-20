<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link type="image/ico" rel="icon" href="/favicon.ico">

    <title>
        {{env('APP_NAME')}}

    </title>

    <link href="{{ asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('assets/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" position="1">

    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">

</head>

<body>

<nav class="navbar fixed-top p-0" style="height: 50px; border-bottom: #C9CACB 1px solid; background-color: white">

    <div class="col-lg-2 d-none d-lg-block" style="height: 50px; border-right: #C9CACB 1px solid">
        <h3 class="navbar-text" style="">Laravel7</h3>
        <div class="navbar-text pull-right d-none d-lg-block" id="aside-toggle">
            <span class="fa fa-bars fa-2x"></span>
        </div>
    </div>
    <div class="col">
        <h5 class="">@yield('breadcrumbs')</h5>
    </div>
    <div class="col text-right">
        <a class="nav-link" href="{{ route('admin.logout') }}">{{--{{ auth()->user()->name }}--}}Выйти</a>
    </div>

</nav>

<div class="container-fluid" style="">

    <div class="row h-100">

        <div class="col-lg-2 d-none d-lg-block pl-0 pr-0" id="aside" style="padding-top: 80px; border-right: #C9CACB 1px solid">
            <div class="position-fixed h-75 overflow-auto p-1" style="width: 16.666667%; margin: 0px">

                @include('B::_sidebar')

            </div>
        </div>

        <div class="col" style="padding-top: 65px">

            {{--@include('B::_breadcrumbs')--}}


            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul style="margin-bottom: 0px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>

    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="{{ asset('assets/bootstrap-datetimepicker/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/jquery.cookie.js') }}"></script>

<script type="text/javascript">
    $( document ).ready(function() {

        let aside = $('#aside');
        let asideCookie = 'asideCookie';

        if ($.cookie(asideCookie)) {
            aside.toggleClass('d-lg-block d-lg-none');
        }

        $('#aside-toggle').click(function () {

            aside.toggleClass('d-lg-block d-lg-none');

            if (aside.hasClass('d-lg-block')) {
                $.removeCookie(asideCookie, { path: '/' });
                return;
            }

            $.cookie(asideCookie, 1, { expires: 7, path: '/' })
        })

        //***********************************************************************

        $('.eraser').click(function(){
            $(this).siblings('input[type=text]').val('').focus();
            //$(this).next().children('input[type=text]').val('').focus();
        });

        //***********************************************************************

        $('.select2').select2();

    })
</script>

@yield('script')

</body>
</html>
