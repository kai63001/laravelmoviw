@extends('master')
@section('title')
    {{ $setting['s_title'] }} - {{ $anime['a_name'] }}
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

<meta name="keywords" content="{{ $video_detail['v_name'] }},{{ str_replace(' ',',',$anime['a_name']) }},{{ $video_detail['v_tags'] }}">
<meta name="description" content="{{ $anime['a_name'] }} {{ $video_detail['v_detail'] }}">

<meta name="author" content="{{ url('') }}">
<meta name="copyright" content="{{ $setting['s_title'] }}" />
<meta name="application-name" content="{{ $anime['a_name'] }}" />
<!-- for Facebook -->
<meta property="og:title" content="{{ $anime['a_name'] }} - {{ $setting['s_title'] }}"/>
<meta property="og:type" content="video.movie"/>
<meta property="og:image" content="{{ $video_detail['v_img'] }}"/>
<meta property="og:description" content="{{ $video_detail['v_detail'] }}"/>
<meta property="og:url" content="{{ url('') }}/watch/{{ $anime['a_id'] }}/{{ str_replace(' ','-',$anime['a_name']) }}"/>
<meta property='og:site_name' content='{{ $video_detail["v_detail"] }}' />
<!-- for Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ $anime['a_name'] }} - {{ $setting['s_title'] }}"/>
<meta name="twitter:description" content="{{ $anime['a_name'] }} {{ $video_detail['v_detail'] }}"/>
<meta name="twitter:image:src" content="{{ $video_detail['v_img'] }}"/>
<?= $setting['s_header'];?>

@endsection
@section('navbar')
@include('include.nav')
@endsection
@section('body')
<?= $setting['s_body'];?>

<br><br><br>
   <div class="container" style="color:white;">
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
                <nav aria-label="breadcrumb" style="color:white;background:{{ $setting['s_maincolor'] }};">
                    <ol class="breadcrumb" style="color:white;background:{{ $setting['s_maincolor'] }};" >
                        <li class="breadcrumb-item"><a href="{{ url('') }}" style="text-decoration:none;color:white;">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;color:white;">Anime</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none;color:white;">{{ $anime['a_name'] }}</li>
                    </ol>
                </nav>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">หลัก</a>
                    </li>
                    @foreach($anime_backup as $row)
                        <li class="nav-item">
                            <a class="nav-link" id="dd{{ $row['ab_id'] }}-tab" data-toggle="tab" href="#dd{{ $row['ab_id'] }}" role="tab" aria-controls="dd{{ $row['ab_id'] }}" aria-selected="false">{{ $row['ab_name'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <?= str_replace('sandboxscrolling','scrolling',$anime['a_iframe']);?>
                    </div>
                    @foreach($anime_backup as $row)
                        <div class="tab-pane fade" id="dd{{ $row['ab_id'] }}" role="tabpanel" aria-labelledby="dd{{ $row['ab_id'] }}-tab">
                            <?= str_replace('sandboxscrolling','scrolling',$row['ab_iframe']);?>
                        </div>
                    @endforeach
                </div>
                <div class="box" style="background:{{ $setting['s_maincolor'] }};padding:5px;margin-top:;">
                   <form action="{{ route('reportvideo') }}" method="POST">
                        @csrf
                        <input type="hidden" name="r_aid" value="{{ $anime['a_id'] }}" >
                        <input type="hidden" name="r_vid" value="{{ $video_detail['v_id'] }}">
                        <input type="hidden" name="r_img" value="{{ $video_detail['v_img'] }}">
                        <input type="hidden" name="r_name" value="{{ $anime['a_name'] }}">

                        <button class="btn" id="report" style="background:#365db3;color:white;border-radius:0px;"> <i class="fas fa-flag"></i> แจ้งไฟล์เสีย</button>
                   </form>
                    
                </div>
                @if(session('successreport'))
                    <div class="" style="color:white;background:#22bb33;padding:15px;">
                        {{ session('successreport') }}
                    </div>
                    <br>
                @endif
           </div>
           <div class="col-md-3">
               <div class="card" style="border-radius:0px;border:0px;background:{{ $setting['s_maincolor'] }};">
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v4.0&appId=153313228407799&autoLogAppEvents=1"></script>
                    <div class="fb-page" data-href="{{ $setting['s_fanpage'] }}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/KuroDev77/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/KuroDev77/">Kuro Dev</a></blockquote></div>
               </div>
           </div>
            <br>
            <div class="col-md-9" >
                <div class="box" style="background:white;">
                    <div style="color:white;" data-colorscheme="" class="fb-comments" data-href="{{ url('') }}/{{ $anime['a_name'] }}/{{ $anime['a_id'] }}}" data-width="100%" data-numposts="5"></div>
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