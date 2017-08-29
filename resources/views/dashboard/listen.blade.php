@extends('dashboard.app')
@section('content')
<div id="append"></div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.6/socket.io.min.js"></script>
<script type="text/javascript">
    //var socket = io('restart-technology.com:3000');
    var socket   = io('http://localhost:3000');
    //getting the auth user id.
    var driverId =  {{\Auth::user()->id}};
    socket.on('location:'+ driverId, function (location) {
    

         $("#append").append(location.speed);

    });
</script>
@endsection