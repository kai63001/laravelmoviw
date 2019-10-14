<?php
    $name_movie = $name;
    $name_movie = str_replace(' ','+',$name_movie);
    $frist_find = file_get_contents('https://www.themoviedb.org/search?query='.$name_movie.'&language=th-TH');
    $start_cut = strpos($frist_find,'<a id="tv_');
    $frist_find = substr($frist_find,$start_cut);
    $frist_find = str_replace('<a id="tv_','',$frist_find);
    $stop_cut = strpos($frist_find,'" data-id="');
    $frist_find = substr($frist_find,0,$stop_cut);
    $stack_url = 'https://api.themoviedb.org/3/tv/'.$frist_find.'?api_key=88fbbabf16279d44af3e9ede3f07b357&language=TH-th';
    $string  = curl_init($stack_url);
    curl_setopt($string, CURLOPT_ENCODING, 'gzip');  
    curl_setopt($string, CURLOPT_RETURNTRANSFER, 1 );
    $result   = curl_exec($string );
    curl_close($string );
    $response = json_decode($result, true);


    


    $stack_url2 = 'https://api.themoviedb.org/3/tv/'.$frist_find.'?api_key=88fbbabf16279d44af3e9ede3f07b357&language=EN-en';
    $string2  = curl_init($stack_url2);
    curl_setopt($string2, CURLOPT_ENCODING, 'gzip');  
    curl_setopt($string2, CURLOPT_RETURNTRANSFER, 1 );
    $result2   = curl_exec($string2 );
    curl_close($string2 );
    $response2 = json_decode($result2, true);
    $title = $response2['name'].' '.' trailer';
    $title = str_replace(' ','+',$title);
    $title = str_replace('&','+',$title);
    $youtube = file_get_contents('https://www.youtube.com/results?search_query='.$title);
    $start = strpos($youtube,'data-context-item-id="');
    $youtube = substr($youtube,$start);
    $youtube = str_replace('data-context-item-id="','',$youtube);
    $stop = strpos($youtube,'"');
    $youtube = substr($youtube,0,$stop);
    
    $count_tags = count($response['genres']);
    $count_tags -= 1;
    // find name

    $find_name = $name;
    $find_name = str_replace(' ','+',$find_name);

    $anime_sugoi = curl('https://www.anime-sugoi.com/index.php?search='.$find_name);
    $start = strpos($anime_sugoi,'<div class="panel-body">');
    $anime_sugoi = substr($anime_sugoi,$start);
    $anime_sugoi = str_replace('<div class="panel-body">','',$anime_sugoi);
    $stop = strpos($anime_sugoi,'</div>');
    $anime_sugoi = substr($anime_sugoi,0,$stop);
    
    $start = strpos($anime_sugoi,'" href="');
    $anime_sugoi = substr($anime_sugoi,$start);
    $anime_sugoi = str_replace('" href="','',$anime_sugoi);
    $stop = strpos($anime_sugoi,'"');
    $anime_sugoi = substr($anime_sugoi,0,$stop);

    $name_anime = curl($anime_sugoi);
    $start = strpos($name_anime,'itemprop="name"><span>');
    $name_anime = substr($name_anime,$start);
    $name_anime = str_replace('itemprop="name"><span>','',$name_anime);
    $stop = strpos($name_anime,'</span>');
    $name_anime = substr($name_anime,0,$stop);

    if($name_anime == ""){
        $name_anime = $response2['name'];
    }
    // end find name
    $subthai = strpos($name_anime,'ซับไทย');
    if($subthai != ""){
        $subornot = "ซับไทย";
    }else{
        $subornot = "พากย์ไทย";
    }

    // detail
        if($response['overview'] == ""){
            $detail_anime = curl($anime_sugoi);
            $start = strpos($detail_anime,'</strong></div>');
            $detail_anime = substr($detail_anime,$start);
            $detail_anime = str_replace('</strong></div>','',$detail_anime);
            $stop = strpos($detail_anime,'</p>');
            $detail_anime = substr($detail_anime,0,$stop);
            $detail_anime = str_replace('<div class="panel-body">','',$detail_anime);
            $detail_anime = str_replace('<p>','',$detail_anime);
            $detail_anime = trim($detail_anime);
            $response['overview'] = $detail_anime;
        }

    // 

    function curl($url) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/');
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
        <form action="{{  route('addanime') }}" method="post">
            @csrf
            <input type="hidden" name="v_bg" value="https://image.tmdb.org/t/p/w1280{{ $response['backdrop_path'] }}">
            <input type="hidden" name="v_sogoi_id" value="{{ $anime_sugoi }}">

            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Title Anime :
                                <input type="text" class="form-control" name="v_name" value="{{ $name_anime }} " style="background:#284485;border-color:#284485;color:white;" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                IMDb Score :
                                <input type="number" class="form-control" name="v_imdb" value="{{ $response['vote_average'] }}" style="background:#284485;border-color:#284485;color:white;" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        Detail :
                        <textarea type="text" class="form-control" name="v_detail" style="background:#284485;border-color:#284485;color:white;" cols="10" rows="5" required>{{ $response['overview'] }}</textarea>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Type :
                                <select name="v_type" id="" class="form-control" style="background:#284485;border-color:#284485;color:white;">
                                    <option value="{{ $subornot }}">{{ $subornot }}</option>
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
                        <input type="text" class="form-control" style="background:#284485;border-color:#284485;color:white;" name="v_tags" value="<?php
                        for($i=0;$i <= $count_tags;$i++){
                            $tag =  $response['genres'][$i]['name'].",";
                            echo $tag;
                        }
                        ?>" >
                    </div>
                    <br>
                </div>
                <div class="col-md-3">
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        <img loading="lazy" src="https://image.tmdb.org/t/p/w1280{{ $response['poster_path'] }}"  onload='console.log("lazy cat");'  width="100%" style="border-radius:3px;"  alt="">
                    </div>
                    <br>
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        <input type="text" class="form-control" name="v_img" style="background:#284485;border-color:#284485;color:white;" value="https://image.tmdb.org/t/p/w1280{{ $response['poster_path'] }}" required>
                    </div>
                </div>
            </div>
            <a href="../" class="btn btn-danger"><i class="fas fa-caret-square-left"></i> Back</a>
            <button class="btn btn-primary" type="submit"> <i class="fas fa-caret-square-right"></i> Next </button>
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