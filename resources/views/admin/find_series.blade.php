<?php
   
    $file = curl('https://superseriesthai.com/include/searchquery.php',$name);
   
    $text = str_replace(' ','+',$name);
    $regex = '/[ก-๙\ ]/';
    $data_eng = preg_replace($regex, '', $text);
    $data_expert = mb_strimwidth($data_eng,0,250,"", "UTF-8");
    //$data_expert= fn_filter_url(mb_strimwidth(fn_undat($data_eng),0,250,"", "UTF-8"));
    $data_expert = trim($data_expert);
    $frist_find = file_get_contents('https://www.themoviedb.org/search?query='.$data_expert.'&language=th-TH');
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

   $start = strpos($file,'<a class="iw_col" href="');
   $file = str_replace('<a class="iw_col" href="','',$file);
   $file = substr($file,$start);
   $stop = strpos($file,'"');
   $file = substr($file,0,$stop);

   $file2 = curl2($file);
    
   $img = $file2;
   $start = strpos($img,'<meta property="og:image"');
   $img = substr($img,$start);
   $stop = strpos($img,'" />');
   $img = substr($img,0,$stop);
   $img = str_replace('<meta property="og:image"','',$img);
   $img = trim($img);
   $img = str_replace('content="','',$img);

   $name_title = $file2;
   $start = strpos($name_title,'<meta property="og:title"');
   $name_title = substr($name_title,$start);
   $stop = strpos($name_title,'" />');
   $name_title = substr($name_title,0,$stop);
   $name_title = str_replace('<meta property="og:title"','',$name_title);
   $name_title = trim($name_title);
   $name_title = str_replace('content="','',$name_title);

   $detail = $file2;
   $start = strpos($detail,'<meta property="og:description"');
   $detail = substr($detail,$start);
   $stop = strpos($detail,'" />');
   $detail = substr($detail,0,$stop);
   $detail = str_replace('<meta property="og:description"','',$detail);
   $detail = trim($detail);
   $detail = str_replace('content="','',$detail);


   $type = $name_title;
   $check_type = strpos($type,'ซับไทย');
   if($check_type != ""){
        $type = "ซับไทย";
   }else{
        $type = "พากย์ไทย";
   }
   $count_tags = count($response['genres']);
    $count_tags -= 1;


   $trailer = $file2;
   $start = strpos($trailer,'https://www.youtube.com/embed/');
   $trailer = substr($trailer,$start);
   $stop = strpos($trailer,'"');
   $trailer = substr($trailer,0,$stop);
   $trailer = str_replace('https://www.youtube.com/embed/','',$trailer);
   $trailer = trim($trailer);





   

   function curl($url,$name) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $post = [
            'sValue' => $name,
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        header('Content-Type: text/html; charset=UTF-8');
        header("Access-Control-Allow-Origin: *");
        $data = curl_exec($ch); 
        curl_close($ch); 
        return $data;   
    }
    function curl2($url) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, 'https://superseriesthai.com');
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
        <form action="{{  route('addseries') }}" method="post">
            @csrf
            <input type="hidden" name="v_bg" value="">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Title Movie :
                                <input type="text" class="form-control" name="v_name" value="{{ $name_title }}" style="background:#284485;border-color:#284485;color:white;" required>
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
                        <textarea type="text" class="form-control" name="v_detail" style="background:#284485;border-color:#284485;color:white;" cols="10" rows="5" required>{{ $detail }}</textarea>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Type :
                                <select name="v_type" id="" class="form-control" style="background:#284485;border-color:#284485;color:white;">
                                    <option value="{{ $type }}">{{ $type }}</option>
                                    <option value="พากย์ไทย">พากย์ไทย</option>
                                    <option value="ซับไทย">ซับไทย</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Trailer :
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="v_trailer" style="background:#284485;border-color:#284485;color:white;" value="{{ $trailer }}" required>
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
                        <img loading="lazy" src="https://image.tmdb.org/t/p/w1280<?= $response['poster_path'];?>"  onload='console.log("lazy cat");'  width="100%" style="border-radius:3px;"  alt="">
                    </div>
                    <br>
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        <input type="text" class="form-control" name="v_img" style="background:#284485;border-color:#284485;color:white;" value="https://image.tmdb.org/t/p/w1280<?= $response['poster_path'];?>" required>
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
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $trailer }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>    
@endsection