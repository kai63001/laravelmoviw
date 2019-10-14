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
        <a href="{{ url('') }}/admin/allvideo/list" class="btn btn-danger"> <i class="fas fa-caret-square-left"></i> Back</a>
        <br><br>
        <div class="row">
            <div class="col-md-2">
                <img src="{{ $vide_find_ep['v_img'] }}" alt="" width="100%;" style="border-radius:2px;border-left:2px solid #ff4a3d;">
            </div>
            <div class="col-md-10">
                <div class="boxm" style="color:white;">
                    <h4>{{ $vide_find_ep['v_name'] }}</h4>
                </div>
                <br>
                <div class="box" style="color:white;">
                    <?= $vide_find_ep['v_detail'];?>
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
        @if(session('botsuccess'))
            <div class="" style="color:white;background:#22bb33;padding:15px;">
                <?php
                    if(session('botsuccess') == 1){
                        ?>
                        Add New Ep Success!!!
                        <?php
                    }elseif(session('botsuccess') == 2){
                        ?>
                        ไม่มีจำนวนตอนที่เพิ่มขึ้น
                        <?php
                    }else{
                        ?>
                        Error!!
                        <?php
                    }
                ?>
            </div>
            <br>
        @endif
        @if(session('fixed'))
            <div class="" style="color:white;background:#22bb33;padding:15px;">
                <?php
                    if(session('fixed') == 1){
                        ?>
                        Fix Success!!!
                        <?php
                    }elseif(session('fixed') == 2){
                        ?>
                        Cant Fix!!
                        <?php
                    }else{
                        ?>
                        Error!!
                        <?php
                    }
                ?>
            </div>
            <br>
        @endif
        <br>
       @if($series != 'ok')
        <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('') }}/admin/auto/addnewep/{{ $vide_find_ep['v_id'] }}/{{ $vide_find_ep['v_name'] }}" class="btn btn-block btn-danger" style="border-radius:0px;background:#ff6d29;border:0px;"> <i class="fas fa-robot"></i> Auto Add New Ep</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('') }}/admin/auto/fixanime/{{ $vide_find_ep['v_id'] }}/{{ $vide_find_ep['v_name'] }}" class="btn btn-block btn-danger" style="border-radius:0px;background:#ff392b;border:0px;"> <i class="fas fa-tools"></i> Fix All</a>
                </div>
            </div>
        <br>

       @endif
        @foreach($ep as $row)
            <div class="row" style="margin-bottom:15px;">
                <div class="col-md-8 col-8">
                    <a href="{{ url('') }}/watch/{{ $row['a_id'] }}/{{ str_replace(' ','-',$row['a_name']) }}" target="blank" class="btn btn-block" style="color:white;border-radius:0px;background:#16274d;border:0px;"> <i class="fas fa-play"></i> {{ $row['a_name'] }}</a>
                </div>
                <div class="col-md-1 col-1">
                    <a href="{{ url('') }}/admin/edit/ep/{{ $row['a_id'] }}/{{ $vide_find_ep['v_id'] }}"  class="btn btn-primary btn-block" style="color:#4287f5;border-radius:0px;background:#16274d;border:0px;"> <i class="fas fa-edit"></i></a>
                </div>
                <div class="col-md-2 col-2">
                    <a href="{{ url('') }}/admin/backupep/{{ $row['a_id'] }}/{{ $vide_find_ep['v_id'] }}" alt="Add Backup"  class="btn btn-primary btn-block" style="color:#22bb33;border-radius:0px;background:#16274d;border:0px;"> Back Up</a>
                    
                </div>
                <div class="col-md-1 col-1">
                    <a href="{{ url('') }}/admin/delete/ep/{{ $row['a_id'] }}"  class="btn btn-danger btn-block" style="color:#f54242;border-radius:0px;background:#16274d;border:0px;"> <i class="fas fa-trash"></i></a>
                </div>
            </div>
        @endforeach
        <?php
            if($series == "ok"){
                ?>
                    <a href="{{ url('') }}/admin/seriesvideo/{{ $vide_find_ep['v_id'] }}" class="btn btn-primary btn-block" style='border-radius:0px;'>Add More Ep</a>
                <?php
            }else{
                ?>
                    <a href="{{ url('') }}/admin/addvideoanime/{{ $vide_find_ep['v_id'] }}" class="btn btn-primary btn-block" style='border-radius:0px;'>Add More Ep</a>
                    
                <?php
            }
        ?>
        <br>
    </div>
@endsection