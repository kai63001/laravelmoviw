@extends('master')
@section('title','Admin - Dashboard')
@section('header')
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <style>
        html,body{
            font-family: 'Kanit', sans-serif !important;
            background:#2B3451 !important;
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
        img {
            background:url('https://i.pinimg.com/originals/9d/6b/d8/9d6bd8f27e57233a1378df1554f3a608.gif');
            background-size:cover;
            background-position:center;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection
@section('body')
<br>

    <div class="container">
        <a href="{{ url('') }}/admin" class="btn btn-danger"> <i class="fas fa-caret-square-left"></i> Back</a>
        <br><br>
        <div class="row">
            <div class="col-md-2">
                <img src="{{ $video['v_img'] }}" alt="" width="100%;" style="border-radius:2px;border-left:2px solid #ff4a3d;">
            </div>
            <div class="col-md-10">
                <div class="boxm" style="color:white;">
                    <h4>{{ $backup['ab_name'] }}</h4>
                </div>
                <br>
                <div class="box" style="color:white;">
                    <?= $video['v_detail'];?>
                </div>
            </div>
        </div>
        <br>
        @if(session('success'))
            <div class="" style="color:white;background:#22bb33;padding:15px;">
                {{ session('success') }}
            </div>
            <br>
        @endif
        <form action="{{ route('leteditbackupep') }}" method="POST">
            @csrf
            <div class="box" style="color:white;">
                Title:
                <input type="text" name="a_name" class="form-control" style="background:#364064;border-color:#364064;color:white;width:60%;" value="{{ $backup['ab_name'] }}" required>
                Iframe:
                <textarea  name="a_iframe" id="" cols="30" rows="5" class="form-control" style="background:#364064;border-color:#364064;color:white;">{{ $backup['ab_iframe'] }}</textarea>
                <input type="hidden" name="a_id" value="{{ $backup['ab_id'] }}">
                <br>
                <button class="btn btn-primary"> <i class="fas fa-save"></i> Save </button>
            </div>
        </form>
        <br>
        <div class="boxm" style="color:white;">
            ตอนที่ :
            <input type="text" class="form-control" id="ep" placeholder="เช่น 1 ถ้าไม่เจอ ให้พิ่มเลขไปเลื่อยๆ">
            <br>
            <span id="find" class="btn btn-danger"><i class="fas fa-search"></i> Anime iframe</span>
            <div id="show" style="color:black;  "></div>
        </div>
    </div>
    <br>
    <?php
            if($series == "ok"){
                $cut_name = $video['v_name'];
            }else{
                $cut_name = str_replace(' ','+',$video['v_name']);
                $start = strpos($cut_name,'+ตอนที่');
                if($start != ""){
                    $cut_name = substr($cut_name,0,$start);
                }
            }
            $cut_name = mb_substr($cut_name,0,20);

        ?>
    <script>
            $('#find').click(function(){
                ep = $('#ep').val();
                if(ep == ""){
                    $('#ep').css('borderColor','red');
                }else{
                    $('#find').text('Searching..');
                    @if($series == "ok")
                        url = "{{ url('') }}/admin/search/series/<?= $cut_name;?>/"+ep;
                    @else
                        url = "{{ url('') }}/admin/searchanime/<?= $cut_name;?>/"+ep;
                    @endif
                    XmlSearchMovie = new XMLHttpRequest();
                    XmlSearchMovie.open('GET',url,true);
                    XmlSearchMovie.send();
                    XmlSearchMovie.onreadystatechange = function(){
                        if(XmlSearchMovie.readyState == 4){
                            $('#show').html(this.responseText);
                            $('#find').text('Success!!');

                        }
                    }
                }
            });
        </script>
@endsection