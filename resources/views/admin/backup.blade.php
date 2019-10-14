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
                <img src="{{ $video_backup['v_img'] }}" alt="" width="100%;" style="border-radius:2px;border-left:2px solid #ff4a3d;">
            </div>
            <div class="col-md-10">
                <div class="boxm" style="color:white;">
                    <h4>{{ $now['a_name'] }}</h4>
                </div>
                <br>
                <div class="box" style="color:white;">
                    <?= $video_backup['v_detail'];?>
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
        <br>
        @foreach($ep as $row)
            <div class="row" style="margin-bottom:15px;">
                <div class="col-md-10 col-8">
                    <a href="{{ url('') }}/watch/{{ $row['ab_aid'] }}/{{ str_replace(' ','-',$row['ab_name']) }}" target="blank" class="btn btn-block" style="color:white;border-radius:0px;background:#16274d;border:0px;"> <i class="fas fa-play"></i> {{ $row['ab_name'] }}</a>
                </div>
                <div class="col-md-1 col-1">
                    <a href="{{ url('') }}/admin/backup/edit/{{ $row['ab_id'] }}/{{ $video_backup['v_id'] }}"  class="btn btn-primary btn-block" style="color:#4287f5;border-radius:0px;background:#16274d;border:0px;"> <i class="fas fa-edit"></i></a>
                </div>
                <div class="col-md-1 col-1">
                    <a href="{{ url('') }}/admin/delete/epbackup/{{ $row['ab_id'] }}"  class="btn btn-danger btn-block" style="color:#f54242;border-radius:0px;background:#16274d;border:0px;"> <i class="fas fa-trash"></i></a>
                </div>
            </div>
        @endforeach
        <a href="{{ url('') }}/admin/anime/backup/{{ $a_id }}" class="btn btn-primary btn-block" style="border-radius:0px;">Add Backup</a>
    </div>
@endsection