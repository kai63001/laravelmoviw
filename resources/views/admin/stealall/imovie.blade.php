<?php

    $url = 'https://www.imovie-hd.com/'.$url;
    
    $name = $url;
    $name = file_get_contents($name);
    $start = strpos($name,'<h1 class="entry-title">');
    $name = substr($name,$start);
    $name = str_replace('<h1 class="entry-title">','',$name);
    $stop = strpos($name,'</h1>');
    $name = substr($name,0,$stop);
    $name = trim($name);

    $imdb = $url;
    $imdb = file_get_contents($imdb);
    $start = strpos($imdb,'<div class="imdb-rating-content">');
    $imdb = substr($imdb,$start);
    $imdb = str_replace('<div class="imdb-rating-content">','',$imdb);
    $stop = strpos($imdb,'</span>');
    $imdb = substr($imdb,0,$stop);
    $imdb = str_replace('<span>','',$imdb);    
    $imdb = trim($imdb);

    $detail = $url;
    $detail = file_get_contents($detail);
    $start = strpos($detail,'เรื่องย่อ');
    $detail = substr($detail,$start);
    $detail = str_replace('เรื่องย่อ','',$detail);
    $stop = strpos($detail,'</p>');
    $detail = substr($detail,0,$stop);
    $detail = str_replace('<br>เรื่องย่อ <em>','',$detail);    
    $detail = trim($detail);
    
    $img = $url;
    $img = file_get_contents($img);
    $start = strpos($img,'<meta property="og:image" content="');
    $img = substr($img,$start);
    $img = str_replace('<meta property="og:image" content="','',$img);
    $stop = strpos($img,'" />');
    $img = substr($img,0,$stop);
    // $img = str_replace('<br>เรื่องย่อ <em>','',$img);    
    $img = trim($img);
    

    $youtube = $url;
    $youtube = file_get_contents($youtube);
    $start = strpos($youtube,'src="https://www.youtube.com/embed/');
    $youtube = substr($youtube,$start);
    $youtube = str_replace('src="https://www.youtube.com/embed/','',$youtube);
    $stop = strpos($youtube,'"');
    $youtube = substr($youtube,0,$stop);
    $youtube = trim($youtube);
    
    $type = $name;
    $chtype = strpos($type,'ซับไทย');
    if($chtype == ''){
        $type = 'พากย์ไทย';
    }else{
        $type = 'ซับไทย';

    }
    
    $tag = $url;
    $tag = file_get_contents($tag);
    $start = strpos($tag,'<span class="categories">');
    $tag = substr($tag,$start);
    $tag = str_replace('<span class="categories">','',$tag);
    $stop = strpos($tag,'</span>');
    $tag = substr($tag,0,$stop);
    $tag = strip_tags($tag);
    $tag = str_replace(' ','',$tag);
    $tag = str_replace('Action','',$tag);
    $tag = str_replace('Adventure','',$tag);
    $tag = str_replace('Biography','',$tag);
    $tag = str_replace('Comedy','',$tag);
    $tag = str_replace('Crime','',$tag);
    $tag = str_replace('Drama','',$tag);
    $tag = str_replace('Family','',$tag);
    $tag = str_replace('Fantasy','',$tag);
    $tag = str_replace('History','',$tag);
    $tag = str_replace('Horror','',$tag);
    $tag = str_replace('Musical','',$tag);
    $tag = str_replace('Mystery','',$tag);
    $tag = str_replace('Romance','',$tag);
    $tag = str_replace('Sci-Fi','',$tag);
    $tag = str_replace('Thriller','',$tag);
    $tag = str_replace('War','',$tag);
    $tag = str_replace('Western','',$tag);
    
    $iframe = $url;
    $iframe = file_get_contents($iframe);    
    $start = strpos($iframe,'$.getJSON( "');
    $iframe = substr($iframe,$start);
    $iframe = str_replace('$.getJSON( "','',$iframe);
    $stop = strpos($iframe,'&bg=');
    $iframe = substr($iframe,0,$stop);
    $iframe = 'https://www.imovie-hd.com/'.$iframe;
    $iframe = curl($iframe);
    $getfilemovie = json_decode(json_encode($iframe),True);
    $getfilemovie = json_decode($getfilemovie,True);

    $encode_iframe2 = base64_encode($getfilemovie['ตัวเล่นหลัก 60 FPS']);
    if($getfilemovie['ตัวเล่นหลัก 60 FPS'] == ""){
        $encode_iframe2 = base64_encode($getfilemovie['ตัวเล่นหลัก']);
    }
    $iframe = $encode_iframe2;
    $iframe = str_rot13($iframe);


    function curl($url) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.imovie-hd.com/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        header('Content-Type: text/html; charset=UTF-8');
        header("Access-Control-Allow-Origin: *");
        $data = curl_exec($ch); 
        curl_close($ch); 
        return $data;   
    }
?>

@extends('master')
@section('title','Admin - Dashboard')
@section('header')
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <style>
        html,body{
            font-family: 'Kanit', sans-serif !important;
            /* background:#2B3451 !important; */
            background:url('https://image.tmdb.org/t/p/w1280{{ $response['backdrop_path'] }}') !important;
            background-position: center !important;
            background-size:cover !important;
            background-repeat: no-repeat !important;
            height: 100%;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
            background:none !important;
            color:white !important;
        }
        .nav-link{
            color: #4F5B85 !important;
        }
        .boxm {
            background:#415175;
            width:100%;
            padding:15px;
            border-radius:3px;
            border-left:3px solid #5C59DA;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }
        .box{
            background:#415175;
            width:100%;
            padding:15px;
            border-radius:3px;
        }
        .bgform{
            background:#16274d;
            padding:15px;
            border-radius:3px;

        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
@endsection
@section('body')

<div id="bg" style="background:rgba(43,52,81,0.97);background-size:cover;height:100%;background-attachment:fixed;">
<br><br>
    <div class="container" style="color:white;">
        <form action="{{  route('addmovie') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Title Movie :
                                <input type="text" class="form-control" name="v_name" value='{{ $name }}' style="background:#284485;border-color:#284485;color:white;" required>
                            </div>
                        </div>
                        <input name="v_iframe" type="hidden" value='<iframe height="550px" sandboxscrolling="no" frameborder="0"allowfullscreen="true" webkitallowfullscreen="true"  mozallowfullscreen="true" class="embed-responsive-item" width="100%" src="<?= url('');?>/play/<?= $iframe;?>/run" allowfullscreen></iframe>'>
                        <div class="col-md-4">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                IMDb Score :
                                <input type="number" class="form-control" name="v_imdb" value="{{ $imdb }}" style="background:#284485;border-color:#284485;color:white;" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        Detail :
                        <textarea type="text" class="form-control" name="v_detail" style="background:#284485;border-color:#284485;color:white;" cols="10" rows="5" required>{{ $detail }}</textarea>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Type :
                                <select name="v_type" id="" class="form-control" style="background:#284485;border-color:#284485;color:white;">
                                    <option value="{{ $type }}"><?php echo $type;?></option>
                                    <option value="พากย์ไทย">พากย์ไทย</option>
                                    <option value="ซับไทย">ซับไทย</option>
                                    <option value="พากย์ไทย/ซับไทย">พากย์ไทย/ซับไทย</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Trailer :
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="v_trailer" style="background:#284485;border-color:#284485;color:white;" value="{{ $youtube }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModalScrollable"><i style="font-size:20px;" class="fas fa-play"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        Tags :
                        <input type="text" class="form-control" style="background:#284485;border-color:#284485;color:white;" name="v_tags" value="{{ $tag }}" required>
                    </div>
                    <br>
                </div>
                <div class="col-md-3">
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        <img loading="lazy" src="{{ $img }}"  onload='console.log("lazy cat");'  width="100%" style="border-radius:3px;"  alt="">
                    </div>
                    <br>
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        <input type="text" class="form-control" name="v_img" style="background:#284485;border-color:#284485;color:white;" value="{{ $img }}" required>
                    </div>
                </div>
            </div>
            <a href="../" class="btn btn-danger"><i class="fas fa-caret-square-left"></i> Back</a>
            <button class="btn btn-primary" id="start" type="submit"> <i class="fas fa-caret-square-right"></i> Next </button>
            <script>
                $('#start').click(function(){
                    $('#start').html('<i class="fas fa-circle-notch fa-spin"></i>');
                });
            </script>
        </form>
    </div>
</div>
<div class="modal fade" id="exampleModalScrollable" style="padding:0px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="padding:0px;">
      <div class="modal-content" style="padding:0px;">
        <div class="modal-body" style="padding:0px;margin:-10px;">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $youtube }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>    
@endsection