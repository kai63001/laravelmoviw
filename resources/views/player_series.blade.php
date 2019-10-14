<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Kuro</title>
</head>
<body style="margin:0px; background-color:black;">
<div style="float:right; margin-right:150px;">
<div style="position:absolute; z-index:99;">
</div>
</div>
<div style="float: left;">

</div>
<script src='https://ssl.p.jwpcdn.com/player/v/8.0.11/jwplayer.js'></script>
<script>jwplayer.key='uoW6qHjBL3KNudxKVnwa3rt5LlTakbko9e6aQ6VUyKQ='</script>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<style>
body,html{margin:0;}
#myElement{
	height:100vh !important;
}
#video_overlays{
  position:absolute;
  top:-20px;
  left:0;
  right:0;
  bottom:0;
  text-align:center;
  width:100%;
  height:100%;
  z-index:1000;
  
}

.player_ads
{
	margin:0 auto;
	position:relative;
	width:300px;
	bottom:-20px;
	text-align:center;
}

.player_ads .close_ads
{
	position:absolute;
	top:0;
	right:0;
	
}

#player p {
    color: black;
}

#player7_code {
    position: relative;
    z-index: 10;
    height: 0px;
    opacity: 1;
    transition: opacity 0.2s;
}

#player7_code_static {
    opacity: 1;
    cursor: pointer;
    position: relative;
    margin: auto;
    left: 0px;
    right: 0px;
    bottom: 0px;
    display: block;
    transition: opacity 0.2s;
    top: -123px;
}
 .container {
        position:absolute;
        width : 100%;
        height : 100vh;
		display:block;
		cursor:pointer;
		z-index:99999999;
  }
  .popupfancy{
        position:absolute;
        width : 100%;
        height : 100vh;
		display:block;
		cursor:pointer;
		z-index:99999999;
		    background: rgba(0, 0, 0, 0.36);
  }
</style>
<style>
        #fixMov {position:absolute; font-family:Arimo,Arial,Helvetica,'Lucida Grande',sans-serif; color:#47A3F6; font-size:2em; background-color:black; border-radius:3px; padding:7px;}
        #fixMov:hover { cursor:pointer; }
    </style>
<style type="text/css">
.skipads{position:absolute;bottom:100px;right:100px;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;font-size:18px;text-decoration:underline;color:#fff;background-color:#272626;border-radius:5px;border:2px solid #3b1314}
#adsclick{position : absolute;top : 0;left : 0;right : 0;bottom : 0;cursor : pointer;}
</style>
<script>
$(function() {
    $('#playervideo').hide(); 
	$('#skipads').hide(); 
	$('#adsclick').hide(); 
});
</script>
<?php
        if($ads_player['s_adsplayer'] != "-"){
            ?>
                <div id='ads'>
        <div id='adsplayer'></div>
        <div id='adsclick'></div>
        <script type='text/javascript'>
            jwplayer('adsplayer').setup({
                autostart: 'false',
                width: '100%',
                height: '100%',
                <?php
                    if($ads_player['s_coverplayer'] != '-'){
                        ?>
                        image: '<?= $ads_player['s_coverplayer'];?>',
                        <?php
                    }
                ?>
                file: '<?= $ads_player['s_adsplayer']; ?>',
            });
            jwplayer("adsplayer").on('complete', function() {
                $('#ads').hide();
                $('#playervideo').show();
            });
            jwplayer("adsplayer").on('error', function() {
                $('#ads').hide();
                $('#skipads').hide();
                $('#playervideo').show();
            });
            jwplayer("adsplayer").on('play', function() {
                $('#adsclick').show();
                $('#skipads').show();
                var timeleft = 5; // กรุณารอ
                var downloadTimer = setInterval(function() {
                    timeleft--;
                    document.getElementById("timeer").textContent = 'กรุณารอ ' + timeleft + ' วิ';
                    if (timeleft <= 0) {
                        document.getElementById("timeer").textContent = 'กดข้ามโฆษณา';

                        document.getElementById("skipads").addEventListener("click", function() {
                            $('#ads').hide();
                            $('#playervideo').show();
                            jwplayer("adsplayer").remove();
                        });
                    }


                }, 1000);
            });

            
            $(document).ready(
                function() {
                    $('#adsclick').click(function() {
                        window.open('https://ufa191.com', '_blank');
                    });
                });
        </script>
        <div class="skipads" id="skipads">
            <span id="timeer">กรุณารอ 5 วิ</span></div>
    </div>

    <div id="playervideo">
            <?php
        }
    ?>
<?php

    $url;
    $url = base64_decode($url);
    $url = str_rot13($url);
    $file = curl($url);
    $file = str_replace('https://player.marimo.me/demo/app-marimo.js?v=1lf7ee7e',asset('js/app-mariomo.js'),$file);
    $file = str_replace('Marimo Design','Kuro Design',$file);
    $file = str_replace('https://marimo.me/','google.com',$file);
    echo $file;
    function curl($url) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, 'hhttps://superseriesthai.com/play/XmEt79Wspp/strangers-from-hell-2019-%E0%B8%95%E0%B8%AD%E0%B8%99%E0%B8%97%E0%B8%B5%E0%B9%88-01-%E0%B8%8B%E0%B8%B1%E0%B8%9A%E0%B9%84%E0%B8%97%E0%B8%A2-1080p');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        header('Content-Type: text/html; charset=UTF-8');
        header("Access-Control-Allow-Origin: *");
        $data = curl_exec($ch); 
        curl_close($ch); 
        return $data;   
    }

?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>