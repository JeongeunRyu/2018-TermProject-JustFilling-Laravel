@extends('layouts.master')
@section('title')
    홈
@endsection
@section('style')
    @include('components.style')
@endsection
@section('content')
    <div id="home-container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset(('media/1.jpg'))}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset(('media/2.jpg'))}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset(('media/3.jpg'))}}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="aboutmacaron"><a class="btn btn-outline-primary btn-lg ab" href="#about">about MACARON</a></div>
        <div class="content p-3 text-center">
            <div id="about">
                <img src="{{asset(('media/mcr_full.png'))}}" class="col-3 mcr-img " alt="마카롱">
            </div>
            <div class="text-box">

                <div><button class="btn btn-outline-primary mcr-info" id="cou">COUQUE</button>

                    <button class="btn btn-outline-primary mcr-info" id="fil">FILLING</button>
                    <div class="cou info-text" style="display: none">꼬그</div>
                    <div class="fil info-text" style="display: none">필링</div>
                </div>

            </div>

            <div class="mcr_text">macaron</div>
            <div class="mcr_txt_sc">
                <i> 쫀득한 <span class="sp">꼬끄</span>와, 부드럽고 달콤한 <span class="sp">필링</span>의 조화가 빚어내는 독특한 식감, 맛, 향,<br>
                    그리고 형형색색의 고운 빛깔이 특색인 프랑스의 디저트중 하나</i>
            </div>




        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            $("#cou").mouseover(function () {
                $(".mcr-img").attr("src", "{{asset(('media/mcr_c.png'))}}");
            });

            $("#fil").mouseover(function () {
                $(".mcr-img").attr("src", "{{asset(('media/mcr_f.png'))}}");
            });
            $(".mcr-info").mouseout(function(){
                $(".mcr-img").attr("src", "{{asset(('media/mcr_full.png'))}}");
            });
            $('.mcr-info').click(function() {

                $('.'+ this.id).toggle();
            });


                $("body").css("display", "none");
                $("body").fadeIn(1000);




        })


    </script>
@endsection
