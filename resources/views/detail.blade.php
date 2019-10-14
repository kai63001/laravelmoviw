@extends('master')
@section('title')
{{ $setting['s_title'] }} - {{ $video_detail['v_name'] }}
@endsection
@section('header')
<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
<style>
    html,body{
        font-family: 'Kanit', sans-serif !important;
        background: {{ $setting['s_bg'] }}; !important;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background:{{ $setting['s_maincolor'] }} !important;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        background-color:{{ $setting['s_maincolor'] }} !important;
        border:0px !important;
        color:black !important;
    }
    a{
        color:black !important;
    }
    .nav-tabs{
        border:0px !important;
    }
    .nav-tabs .nav-link{
        border:0px !important;
        border-radius:0px !important;
    }
    .fb_iframe_widget_fluid_desktop, .fb_iframe_widget_fluid_desktop span, .fb_iframe_widget_fluid_desktop iframe {
            max-width: 100% !important;
            width: 100% !important;
            color:white !important;
 }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
<meta name="keywords" content="{{ $video_detail['v_name'] }},{{ str_replace(' ',',',$video_detail['v_name']) }},{{ $video_detail['v_tags'] }}">
<meta name="description" content="{{ $video_detail['v_name'] }} {{ $video_detail['v_detail'] }}">

<meta name="author" content="{{ url('') }}">
<meta name="copyright" content="{{ $setting['s_title'] }}" />
<meta name="application-name" content="{{ $video_detail['v_name'] }}" />
<!-- for Facebook -->
<meta property="og:title" content="{{ $video_detail['v_name'] }} - {{ $setting['s_title'] }}" />
<meta property="og:type" content="video.movie" />
<meta property="og:image" content="{{ $video_detail['v_img'] }}" />
<meta property="og:description" content="{{ $video_detail['v_detail'] }}" />
<meta property="og:url" content="{{ url('') }}/{{ $video_detail['v_id'] }}/{{ str_replace(' ','-',$video_detail['v_name']) }}" />
<meta property='og:site_name' content='{{ $video_detail["v_detail"] }}' />
<!-- for Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ $video_detail['v_name'] }} - {{ $setting['s_title'] }}" />
<meta name="twitter:description" content="{{ $video_detail['v_name'] }} {{ $video_detail['v_detail'] }}" />
<meta name="twitter:image:src" content="{{ $video_detail['v_img'] }}" />
<?= $setting['s_header']; ?>
@endsection
@section('navbar')
@include('include.nav')
@endsection
@section('body')
<?= $setting['s_body']; ?>

<br><br><br>
<div class="container" style="color:black;">
    @foreach($ads as $row)
    <div class="row" style="margin-bottom:5px;">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <a target="_blank" href="{{ $row['ad_url'] }}"><img src="{{ $row['ad_img'] }}" width="100%" alt=""></a>
        </div>
        <div class="col-md-2"></div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ $video_detail['v_img'] }}" width="100%" alt="">
                </div>
                <div class="col-md-9">
                    <h1 style="font-size:1.875rem;line-height:2.5rem;font-weight:700;">{{ $video_detail['v_name'] }}</h1>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" style="color:black;" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">ข้อมูลทั่วไป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " style="color:black;" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">เรื่องย่อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:black;" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">ตัวอย่าง</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><span>
                                <font color="black"> <img src="http://pop-verse.com/wp-content/uploads/2013/04/IMDb.png" width="50" height="40px"> {{ $video_detail['v_imdb'] }}</font>
                            </span>
                            <br>
                            <span>
                                <font color="black"> เสียงพากษ์ : {{ $video_detail['v_type'] }}</font>
                            </span>
                            <br>
                            <span>
                                <font color="black">คนเข้าชม : {{ number_format($video_detail['v_view']) }} views </font>
                            </span>
                            <br>
                            <span>
                                <font color="black">Genre: </font>
                                <?php

                                $tags = explode(',', $video_detail['v_tags']);
                                $count = count($tags) - 1;

                                for ($i = 0; $i <= $count; $i++) {
                                    if (!$tags[$i] == "") {
                                        ?>
                                        <a class="badge badge-info" style="background:{{ $setting['s_maincolor'] }};" href="{{ url('') }}/tags/video/<?= $tags[$i]; ?>"> <?= $tags[$i]; ?> </a>
                                <?php
                                    }
                                }

                                ?>
                            </span>
                        </div>
                        <div class="tab-pane fade " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="Description">
                                <p>
                                    <font color="black"><?= $video_detail['v_detail']; ?></font>
                                </p>
                                <p class="Genre">

                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video_detail['v_trailer'] }}" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php
            if ($video_detail['v_movie'] == "1") {
                ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">หลัก</a>
                    </li>
                    @foreach($movie_backup as $row)
                    <li class="nav-item">
                        <a class="nav-link" id="dd{{ $row['mb_id'] }}-tab" data-toggle="tab" href="#dd{{ $row['mb_id'] }}" role="tab" aria-controls="dd{{ $row['mb_id'] }}" aria-selected="false">{{ $row['mb_name'] }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <?= str_replace('sandboxscrolling', 'scrolling', $video_ifram1['m_iframe']); ?>
                    </div>
                    @foreach($movie_backup as $row)
                    <div class="tab-pane fade" id="dd{{ $row['mb_id'] }}" role="tabpanel" aria-labelledby="dd{{ $row['mb_id'] }}-tab">
                        <?= str_replace('sandboxscrolling', 'scrolling', $row['mb_iframe']); ?>
                    </div>
                    @endforeach
                </div>

                <div class="box" style="background:{{ $setting['s_maincolor'] }};padding:5px;margin-top:;">
                    <form action="{{ route('reportvideo') }}" method="POST">
                        @csrf
                        <input type="hidden" name="r_aid" value="-">
                        <input type="hidden" name="r_img" value="{{ $video_detail['v_img'] }}">
                        <input type="hidden" name="r_vid" value="{{ $video_detail['v_id'] }}">
                        <input type="hidden" name="r_name" value="{{ $video_detail['v_name'] }}">
                        <button class="btn" id="report" style="background:#365db3;color:white;border-radius:0px;"> <i class="fas fa-flag"></i> แจ้งไฟล์เสีย</button>
                    </form>
                </div>
                @if(session('successreport'))
                <div class="" style="color:white;background:#22bb33;padding:15px;">
                    {{ session('successreport') }}
                </div>
                <br>
                @endif
            <?php

            } else {
                ?>
                @foreach ($video_ifram1 as $row)
                <a href="{{ url('') }}/watch/{{ $row['a_id'] }}/{{ str_replace(' ','-',$row['a_name']) }}" target="_blank" style="border-radius:2px;background:{{ $setting['s_maincolor'] }};color:white;" class="btn btn-block"> <i class="fas fa-play"></i> {{ $row['a_name'] }}</a>
                @endforeach
            <?php
            }
            ?>
        </div>
        <div class="col-md-3">
            <div class="card" style="border-radius:0px;border:0px;background:{{ $setting['s_maincolor'] }};">
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v4.0&appId=153313228407799&autoLogAppEvents=1"></script>
                <div class="fb-page" data-href="{{ $setting['s_fanpage'] }}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/KuroDev77/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/KuroDev77/">Kuro Dev</a></blockquote>
                </div>
            </div>

            <br>
            <!-- @foreach($tag as $row)
                <a class="badge badge-danger" href="https://77iptv.com//tags.html?tags=ผจญ">{{ $row['t_name'] }}</a>
               @endforeach -->
        </div>
        <br>
        <div class="col-md-9">
            <div class="box" style="background:white;">
                <div class="fb-comments" data-href="{{ url('') }}/{{ $video_detail['v_name'] }}/{{ $video_detail['v_id'] }}}" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </div>
</div>

<br><br><br>
<br><br><br>
@include('include.footer')
@endsection
@section('script')



@endsection