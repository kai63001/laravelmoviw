<?php
     $animehdzero = curl('https://www.animehdzero.com/catagory/'.$url);
     //name
         $name = $animehdzero;
 
         $findep = $animehdzero;
         
         $start = strpos($findep,'<div style="text-align:center;">');
         $findep = substr($findep,$start);
         $findep = str_replace('<div style="text-align:center;">','',$findep);
         $stop = strpos($findep,'</div>');
         $findep = substr($findep,0,$stop);
         $exfindep = explode('<p>',$findep);
         
         $ep1 = $exfindep[1];
         $bhep1 = strstr($ep1,'</p>');
         $ep1 = str_replace($bhep1,'',$ep1);
         $ep1 = trim($ep1);
         $start = strpos($ep1,'ตอนที่ ');
         $ep1 = substr($ep1,$start);
         $ep1 = str_replace('ตอนที่ ','',$ep1);
         
         $chep1 = strpos($ep1,"OVA");
         if($chep1 != ""){
            $ep1 = "1";
         }
         $ep1 = str_replace('ซับไทย','',$ep1);
         $ep1 = str_replace('พากย์ไทย','',$ep1);
         $ep1 = str_replace(' ','',$ep1);

         $countep = count($exfindep) -1;
         $lastep = $exfindep[$countep];
         $bhlastep = strstr($lastep,'</p>');
         $lastep = str_replace($bhlastep,'',$lastep);
         $lastep = trim($lastep);
         $start = strpos($lastep,'ตอนที่ ');
         $lastep = substr($lastep,$start);
         $lastep = str_replace('ตอนที่ ','',$lastep);
 
         // echo $lastep;
         $chlastep = strpos($lastep,"OVA");
         
         if($chlastep != ""){
            $lastep = $countep-1;
         }
 
         $start = strpos($name,'<title>');
         $name = substr($name,$start);
         $name = str_replace('<title>','',$name);
         $stop = strpos($name,"|");
         $name = substr($name,0,$stop);
 
         $type = strpos($name,'ซับไทย');
         if($type != ""){
             $type = "ซับไทย";
         }else{
             $type = "พากย์ไทย";
         }
         $name = str_replace('ซับไทย','',$name);
         $name = str_replace('พากย์ไทย','',$name);
         $name = str_replace('  ',' ',$name);
         $only_name = str_replace(' ','+',$name);
         $only_name = str_replace('ภาค2','',$only_name);
         $only_name = str_replace('Season 2','',$only_name);
         $only_name = str_replace('season 2','',$only_name);
         $only_name = str_replace('ss 2','',$only_name);
         $only_name = str_replace('SS 2','',$only_name);
         
         
         $name = $name.'ตอนที่ '.$ep1.'-'.$lastep.' '.$type;
         $name = str_replace('ซับไทย ซับไทย','ซับไทย',$name);
         $name = str_replace('พากย์ไทย พากย์ไทย','พากย์ไทย',$name);

        //  echo $name;
     //close name
     //findimdb 
         
 
         $regex = '/[ก-๙\ ]/';
         $data_eng = preg_replace($regex, '', $only_name);
         $data_expert = mb_strimwidth($data_eng,0,250,"", "UTF-8");
         $the_name = str_replace('++','',$data_expert);
         $the_name = str_replace('?','',$the_name);
         $the_name = str_replace('Season+2','',$the_name);
         $frist_find = file_get_contents('https://www.themoviedb.org/search?query='.$the_name.'&language=th-TH');
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
 
         // $img = $response['poster_path'];
 
         //tags
         $count_tags = count($response['genres']);
         $count_tags -= 1;
        //  for($i=0;$i <= $count_tags;$i++){
        //      $tag =  $response['genres'][$i]['name'].",";
        //      echo $tag;
        //  }
        $detail = $animehdzero;
        $start = strpos($detail,'<hr><br>');
        $detail = substr($detail,$start);
        $detail = str_replace('<hr><br>','',$detail);
        $stop = strpos($detail,'<br>');
        $detail = substr($detail,0,$stop);
        $detail = strip_tags($detail);
        $detail = trim($detail);
        $stack_url2 = 'https://api.themoviedb.org/3/tv/'.$frist_find.'?api_key=88fbbabf16279d44af3e9ede3f07b357&language=EN-en';
        $string2  = curl_init($stack_url2);
        curl_setopt($string2, CURLOPT_ENCODING, 'gzip');  
        curl_setopt($string2, CURLOPT_RETURNTRANSFER, 1 );
        $result2   = curl_exec($string2 );
        curl_close($string2 );
        $response2 = json_decode($result2, true);
        $title = $the_name.' '.' trailer';
        $title = str_replace(' ','+',$title);
        $title = str_replace('&','+',$title);
        $youtube = file_get_contents('https://www.youtube.com/results?search_query='.$title);
        $start = strpos($youtube,'data-context-item-id="');
        $youtube = substr($youtube,$start);
        $youtube = str_replace('data-context-item-id="','',$youtube);
        $stop = strpos($youtube,'"');
        $youtube = substr($youtube,0,$stop);

        if($response['poster_path'] == ""){
            $img = $animehdzero;
            $start = strpos($img,'<img class="img-fluid img-thumbnail" style="max-width:200px;" src="');
            $img = substr($img,$start);
            $img = str_replace('<img class="img-fluid img-thumbnail" style="max-width:200px;" src="','',$img);
            $stop = strpos($img,'"');
            $img = substr($img,0,$stop);

        }else{
            $img = "https://image.tmdb.org/t/p/w1280".$response['poster_path'];
        }
     function curl($url) {
         $ch = curl_init(); 
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_REFERER, 'https://www.animehdzero.com/');
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

            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Title Anime :
                                <input type="text" class="form-control" name="v_name" value="{{ $name }} " style="background:#284485;border-color:#284485;color:white;" required>
                            </div>
                        </div>
                        <input type="hidden" name="v_hdzero" value="1">
                        <input type="hidden" name="v_idhdzero" value="{{ $url }}">

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
                        <input type="text" class="form-control" style="background:#284485;border-color:#284485;color:white;" name="v_tags" value="<?php
                        for($i=0;$i <= $count_tags;$i++){
                            $tag =  $response['genres'][$i]['name'].",";
                            echo $tag;
                        }
                        ?>" required>
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