<?php

    $name = $name;
    $ep = $ep;
    
    $name = trim($name);
    $file = curl('https://superseriesthai.com/include/searchquery.php',$name);
    
    $start = strpos($file,'<a class="iw_col" href="');
    $file = str_replace('<a class="iw_col" href="','',$file);
    $file = substr($file,$start);
    $stop = strpos($file,'"');
    $file = substr($file,0,$stop);

    $file2 = curl2($file);

    $ex_file2 = explode('<p class="bg-secondary"><a class="text-white" href="',$file2);

    $count = count($ex_file2) - 1;

    $series = $ex_file2[$ep];

    $bh = strstr($series,'"');

    $series = str_replace($bh,'',$series);

    $getiframe = curl2($series);
    $start = strpos($getiframe,'https://player.marimo.me/demo/?key=');
    $getiframe = substr($getiframe,$start);
    $stop = strpos($getiframe,'"');
    $getiframe = substr($getiframe,0,$stop);
    $getiframe = str_rot13($getiframe);
    $getiframe = base64_encode($getiframe);
    $iframe_1 = '<iframe height="550px" sandboxscrolling="no" frameborder="0"allowfullscreen="true" webkitallowfullscreen="true"  mozallowfullscreen="true" class="embed-responsive-item" width="100%" src="'.url('').'/play-series/'.$getiframe.'/play" allowfullscreen></iframe>';
    

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
        if($getiframe){
            ?>
                Iframe : <a target="_blank" href="{{ url('') }}/play-series/<?= $getiframe;?>/play">ดูตัวอย่าง</a>
                <input type="text" class="form-control" value="<?php echo htmlentities($iframe_1);?> ">
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


   