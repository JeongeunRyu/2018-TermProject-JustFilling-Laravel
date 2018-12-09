@extends('layouts.indexLo')
@section('style')
    @include('components.style')
@endsection
@section('content')

    <div class="index-container">

        <div class="title">
            JustFilling
        </div>
        <button type="button" class="btn btn-primary btn-lg px-5 start-btn"  onclick = "location.href = '{{url('info')}}' ">START</button>
        <video id="mainvideo" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
            <source src="media/video.mp4"></video>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("body").css("display", "none");
            $("body").fadeIn(1000);
        });
    </script>
@endsection
