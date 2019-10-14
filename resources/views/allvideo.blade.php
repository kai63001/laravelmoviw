@extends('master')
@section('title')
    {{ $setting['s_title'] }} - หนังทั้งหมด
@endsection
@section('header')
<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
<style>
    html,body{
        font-family: 'Kanit', sans-serif !important;
        background: <?= $setting['s_bg'];?> !important;
    }

        
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
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
    <div class="container">
    @foreach($ads as $row)
            <div class="row" style="margin-bottom:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <a target="_blank" href="{{ $row['ad_url'] }}"><img src="{{ $row['ad_img'] }}" width="100%" alt=""></a>
                </div>
                <div class="col-md-2"></div>
            </div>
        @endforeach
        <h1>วิดีโอทั้งหมด</h1>
        <div class="row">
            @foreach($movie as $row)
            <div class="col-md-2 col-6" style="margin-bottom:15px;">
                    <a href="{{ url('') }}/{{ $row['v_id'] }}/{{ str_replace(' ','-',$row['v_name']) }}" style="text-decoration:none;color:white;height:100%;" tabindex="0"> 
                        <div class="card" style="border:0px;cursor:pointer;background:white;color:black;" onclick="window.location='';">
                        <img src="{{ $row['v_img'] }}" <?php
                                if ( $detect->isMobile() ) {
                                    ?>
                                        height="250px"
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
        {{ $movie->links() }}

    </div>
    
    <br><br><br>
    <br><br><br>
@endsection
@section('script')

    @include('include.footer')

@endsection