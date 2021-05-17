<html>

<head>

    <title></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('../css/bootstrap-rtl.css')}}">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->

    <!--Fontawesome-->
    <link rel="stylesheet" href="{{asset('../css/font/all.css')}}">

    <!--Custom-->
    <link rel="stylesheet" href="{{asset('../css/style.css')}}">

</head>

<body>


{{--Navbar--}}
@include('include/header')




<div class="container-fluid ">
    <div class="row ">

        {{--List--}}

        @if(auth()->user())
            @include('include.sidebarMenu')
        @endif

        {{--Content--}}
        @yield('content')



    </div>
</div>



<!--jquery and Bootstrap.js-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e385633e7a2e9feba132', {
        cluster: 'ap1',
        encrypted: false
    });

    // var channel = pusher.subscribe('my-channel');
    // channel.bind('my-event', function(data) {
    //     alert(JSON.stringify(data));
    // });
</script>

<script src="{{asset('js/pusherNotifications.js')}}"></script>


</body>
</html>
