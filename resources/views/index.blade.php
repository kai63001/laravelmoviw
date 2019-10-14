@extends('master')
@section('title')
    {{ $setting['s_title'] }}
@endsection
@section('header')
<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
<meta name="keywords" content="{{ $setting['s_keyword'] }}">
<meta name="description" content="{{ $setting['s_des'] }}">
<meta name="author" content="{{ url('') }}">
<style>
    html,body{
        font-family: 'Kanit', sans-serif !important;
        background: {{ $setting['s_bg'] }} !important;
    }
    .slick-slider .slick-next{
        background: url({{ asset('img/sprite@2x.png')}});
        
    }
    @media only screen and (-webkit-min-device-pixel-ratio: 1.5), not all, only screen and (min-resolution: 240dpi){
        .slick-slider .slick-next{
            background: url({{ asset('img/sprite@2x.png')}});
        }
    }
    img {
        background:url('https://i.pinimg.com/originals/9d/6b/d8/9d6bd8f27e57233a1378df1554f3a608.gif');
        background-size:cover;
        background-position:center;
    }
        
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick-th.css') }}">

<link rel="stylesheet" href="https://www.jqueryscript.net/css/jquerysctipttop.css">
<?= $setting['s_header'];?>
@endsection
@section('navbar')
@include('include.nav')
@endsection
@section('body')
<?= $setting['s_body'];?>

@include('include.Mobile_Detect')
<?php

    $detect = new Mobile_Detect;

    

?>
    <br><br>
    <br><br>
    <div class="container" style="color:black;height:100%;">
    @foreach($ads as $row)
            <div class="row" style="margin-bottom:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <a target="_blank" href="{{ $row['ad_url'] }}"><img src="{{ $row['ad_img'] }}" width="100%" alt=""></a>
                </div>
                <div class="col-md-2"></div>
            </div>
        @endforeach
            <h2>คนชอบดูมากที่สุด</h2>
            <div class="slider responsive" style="height:100%;">
                @foreach ($view_video as $row)
                <div class="multiple" style="height:100%;">
                        <a href="{{ url('') }}/{{ $row['v_id'] }}/{{ str_replace(' ','-',$row['v_name']) }}" style="text-decoration:none;color:white;height:100%;"> 
                            <div class="card" style="padding:10px;border:0px;cursor:pointer;background:white;color:black;" onclick="window.location='';">
                            <img src="{{ $row['v_img'] }}" <?php
                                if ( $detect->isMobile() ) {
                                    ?>
                                        height="180px"
                                    <?php
                                }else{
                                    ?>
                                        height="250px"
                                    <?php
                                }
                            ?>width="100%" alt="">
                            <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $row['v_name'] }}</p>
                            <span style="font-size:13px;margin-top:-15px;"><i class="fas fa-star" style="color:#ffd700;"></i>{{ $row['v_imdb'] }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
                
                
            </div>
            <?php
                if($check_movie != 0){
                    ?>
                <h2>หนังมาใหม่</h2>
                <div class="slider responsive">
                    @foreach ($video as $row)
                        <div class="multiple" >
                            <a href="{{ url('') }}/{{ $row['v_id'] }}/{{ str_replace(' ','-',$row['v_name']) }}" style="text-decoration:none;color:white;"> 
                                <div class="card" style="padding:10px;border:0px;cursor:pointer;background:white;color:black;" onclick="window.location='';">
                                <img src="{{ $row['v_img'] }}" <?php
                                if ( $detect->isMobile() ) {
                                    ?>
                                        height="180px"
                                    <?php
                                }else{
                                    ?>
                                        height="250px"
                                    <?php
                                }
                            ?>width="100%" alt="">
                                <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $row['v_name'] }}</p>
                                <span style="font-size:13px;margin-top:-15px;"><i class="fas fa-star" style="color:#ffd700;"></i>{{ $row['v_imdb'] }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                    <?php
                }
            ?>
            <?php
                if($check_anime != 0){
                    ?>
                <h2>อนิเมะมาใหม่</h2>
                <div class="slider responsive">
                    @foreach ($anime as $row)
                        <div class="multiple" >
                            <a href="{{ url('') }}/{{ $row['v_id'] }}/{{ str_replace(' ','-',$row['v_name']) }}" style="text-decoration:none;color:white;"> 
                                <div class="card" style="padding:10px;border:0px;cursor:pointer;background:white;color:black;" onclick="window.location='';">
                                <img src="{{ $row['v_img'] }}" <?php
                                if ( $detect->isMobile() ) {
                                    ?>
                                        height="180px"
                                    <?php
                                }else{
                                    ?>
                                        height="250px"
                                    <?php
                                }
                            ?>width="100%" alt="">
                                <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $row['v_name'] }}</p>
                                <span style="font-size:13px;margin-top:-15px;"><i class="fas fa-star" style="color:#ffd700;"></i>{{ $row['v_imdb'] }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                    <?php
                }
            ?>
            
            <?php
                if($check_series != 0){
                    ?>
                <h2>ซีรีย์มาใหม่</h2>
                <div class="slider responsive">
                    @foreach ($series as $row)
                        <div class="multiple" >
                            <a href="{{ url('') }}/{{ $row['v_id'] }}/{{ str_replace(' ','-',$row['v_name']) }}" style="text-decoration:none;color:white;"> 
                                <div class="card" style="padding:10px;border:0px;cursor:pointer;background:white;color:black;" onclick="window.location='';">
                                <img src="{{ $row['v_img'] }}" <?php
                                if ( $detect->isMobile() ) {
                                    ?>
                                        height="180px"
                                    <?php
                                }else{
                                    ?>
                                        height="250px"
                                    <?php
                                }
                            ?>width="100%" alt="">
                                <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $row['v_name'] }}</p>
                                <span style="font-size:13px;margin-top:-15px;"><i class="fas fa-star" style="color:#ffd700;"></i>{{ $row['v_imdb'] }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                    <?php
                }
            ?>
                
                <h2>วิดีโอทั้งหมด</h2>
                <div class="row">
                    @foreach ($all_video as $row)
                        <div class="col-md-2 col-6">
                            <a href="{{ url('') }}/{{ $row['v_id'] }}/{{ str_replace(' ','-',$row['v_name']) }}" style="text-decoration:none;color:white;"> 
                                <div class="card" style="border:0px;cursor:pointer;background:white;color:black;" onclick="window.location='';">
                                <img src="{{ $row['v_img'] }}" <?php
                                if ( $detect->isMobile() ) {
                                    ?>
                                        height="220px"
                                    <?php
                                }else{
                                    ?>
                                        height="250px"
                                    <?php
                                }
                            ?>width="100%" alt="">
                                <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $row['v_name'] }}</p>
                                <span style="font-size:13px;margin-top:-15px;"><i class="fas fa-star" style="color:#ffd700;"></i>{{ $row['v_imdb'] }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        <br>
                        <a href="{{ url('') }}/วิดีโอทั้งหมด" class="btn btn-block btn-primary" style="background:{{ $setting['s_maincolor'] }};border-color:{{ $setting['s_maincolor'] }};border-radius:0px;"> <i class="fas fa-th-list"></i> ดูวิดีโอทั้งหมด </a>
                    </div>
                </div>
    
        </div>
    </div>
    
    <br><br><br>
    <br><br><br>
@endsection
@section('script')
<script src="{{ asset('js/slick.js') }}"></script>

    <script>

        $('.responsive').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 6,
            responsive: [
            {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
            },
            {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
            },
            {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
            }
            ]
            });
           
    </script>
    @include('include.footer')

@endsection