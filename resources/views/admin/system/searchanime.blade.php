<?php

    $name = $name;
    $ep = $ep;
    $name = str_replace(' ','+',$name);
    $name = str_replace('!','',$name);
    // anime sugoi
        $anime_sugoi = curl('https://www.anime-sugoi.com/index.php?search='.$name);

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
    
        $anime_sugoi = curl($anime_sugoi);
        $start = strpos($anime_sugoi,'<div class="b123"><br>');
        $anime_sugoi = substr($anime_sugoi,$start);
        $anime_sugoi = str_replace('<div class="b123"><br>','',$anime_sugoi);
        $stop = strpos($anime_sugoi,'</center><br></div>');
        $anime_sugoi = substr($anime_sugoi,0,$stop);
        
        $animefind = explode('<p>',$anime_sugoi);
        
        $findep = $animefind[$ep];
        $ep_def = $ep;
        
        $check_href = strpos($findep,'href');

        if($check_href == ""){
          $ep += 1;
          $findep = $animefind[$ep];
        }
        
        $show_name = $findep;
        $show_name = strip_tags($show_name);
        $show_name = explode('|',$show_name);

        $start = strpos($findep,'href="');
        $findep = substr($findep,$start);
        $findep = str_replace('href="','',$findep);
        $stop = strpos($findep,'"');
        $findep = substr($findep,0,$stop);
        $check_href = strpos($findep);
        

        $animesugoi_video = curl($findep);
        $start = strpos($animesugoi_video,'var ttt = "');
        $animesugoi_video = substr($animesugoi_video,$start);
        $animesugoi_video = str_replace('var ttt = "','',$animesugoi_video);
        $stop = strpos($animesugoi_video,'"');
        $animesugoi_video = substr($animesugoi_video,0,$stop);
        $animesugoi_video = str_replace('https://www.anime-sugoi.com/player/','',$animesugoi_video);
        $iframe_sugoi = '<iframe height="460px" sandboxscrolling="no" frameborder="0"allowfullscreen="true" webkitallowfullscreen="true"  mozallowfullscreen="true" class="embed-responsive-item" width="100%" src="'.url('').'/player_sugoi'.'/'.$animesugoi_video.'/play" allowfullscreen></iframe>';
        
    // anime sugoi

    // animehdzero
        
        $hdzero = curl('https://www.animehdzero.com/search.php?key='.$name);

        $start = strpos($hdzero,'<a href="https://animehdzero.com/catagory/');
        $hdzero = substr($hdzero,$start);
        $hdzero = str_replace('<a href="','',$hdzero);
        $stop = strpos($hdzero,'"');
        $hdzero = substr($hdzero,0,$stop);
        // เข้ามาใน anime แล้ว
        $hdzero = file_get_contents($hdzero);
        $start = strpos($hdzero,'<div style="text-align:center;">');
        $hdzero = substr($hdzero,$start);
        $hdzero = str_replace('<div style="text-align:center;">','',$hdzero);
        $stop = strpos($hdzero,'</div>');
        $hdzero = substr($hdzero,0,$stop);
        $ex_hdzero = explode('<a href="',$hdzero);
        $now_hdzero = $ex_hdzero[$ep];
        $bhexhdzero = strstr($now_hdzero,'"');
        $now_hdzero = str_replace($bhexhdzero,'',$now_hdzero);

        $name_hdzero = $now_hdzero;
        $name_hdzero = str_replace('https://animehdzero.com/watch/','',$name_hdzero);

        $url_hdzero = str_replace(' ','+',$now_hdzero);
        $url_hd_video = file_get_contents($url_hdzero);
        $start = strpos($url_hd_video,'https://www.animehdzero.com/player/embed.php?link=');
        $url_hd_video = substr($url_hd_video,$start);
        $url_hd_video = str_replace('https://www.animehdzero.com/player/embed.php?link=','',$url_hd_video);
        $stop = strpos($url_hd_video,'"');
        $url_hd_video = substr($url_hd_video,0,$stop);
        $url_hd_video = str_rot13($url_hd_video);
        $url_hd_video = str_replace('/','-',$url_hd_video);
        $iframe_hdzero = '<iframe height="460px" sandboxscrolling="no" frameborder="0"allowfullscreen="true" webkitallowfullscreen="true"  mozallowfullscreen="true" class="embed-responsive-item" width="100%" src="'.url('').'/play/'.$url_hd_video.'/run" allowfullscreen></iframe>';
        // echo $name_hdzero;
        // echo htmlentities($iframe_hdzero);
    // animehdzero
    



    
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Searching..</title>
    <style>
        html,body{
            width:100%;
            height:100%;
            font-family: 'Fredoka One','Kanit', cursive;
        }
    </style>
</head>
<body style="color:black;">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel"> Movie File </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <?php
            if($animesugoi_video != ""){
              ?>
                <?= $show_name[0];?> <a target="_blank" href="<?= url('');?>/player_sugoi/<?= $animesugoi_video;?>/play">ตัวอย่าง</a> :
                <br>
                <input type="text" class="form-control" value="<?= htmlentities($iframe_sugoi);?>">
              <?php
            }
        ?>
        <?php
            if($url_hd_video != ""){
              ?>
                <?= $name_hdzero;?> <a target="_blank" href="<?= url('');?>/play/<?=$url_hd_video?>/run">ตัวอย่าง</a> :
                <br>
                <input type="text" class="form-control" value="<?= htmlentities($iframe_hdzero);?>">
              <?php
            }
        ?>
        
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#myModal').modal('toggle')

</script>
</body>
</html>


   