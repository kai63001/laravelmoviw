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
                    <h4>{{ $video['v_name'] }}</h4>
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
        <form action="{{ route('editvideoedit') }}" method="POST">
            @csrf
            <div class="box" style="color:white;">
                <div class="row">
                    <div class="col-md-9">
                        Title :
                        <input type="text" class="form-control" name="v_name" style="background:#1b2a4d;border-color:#1b2a4d;color:white;" value="{{ $video['v_name'] }}">
                        Detail :
                        <input type="hidden" class="form-control" name="v_id" value="{{ $video['v_id'] }}">
                        <textarea name="v_detail" id="" cols="30" rows="5" style="background:#1b2a4d;border-color:#1b2a4d;color:white;" class="form-control">{{ $video['v_detail'] }}</textarea>
                        <br>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                                Type :
                                <select name="v_type" id="" class="form-control" style="background:#284485;border-color:#284485;color:white;">
                                    <option value="{{ $video['v_type'] }}">{{ $video['v_type'] }}</option>
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
                                        <input type="text" class="form-control" name="v_trailer" style="background:#284485;border-color:#284485;color:white;" value="{{ $video['v_trailer'] }}" required>
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
                        <input type="text" class="form-control" style="background:#284485;border-color:#284485;color:white;" name="v_tags" value="{{ $video['v_tags'] }}" >
                    </div>

                    </div>
                    <div class="col-md-3">
                        <img src="{{ $video['v_img'] }}" width="100%" alt="">
                        <br><br>
                        <input type="text" class="form-control" name="v_img" style="background:#1b2a4d;border-color:#1b2a4d;color:white;" value="{{ $video['v_img'] }}">

                    </div>
                </div>
                <br>
                <button class="btn btn-primary"> <i class="fas fa-save"></i> Save </button>
                <?php 
                    if($video['v_movie'] != '1'){

                    }else{
                        ?>
                            <a href="{{ url('') }}/admin/edit/movie/{{ $video['v_id'] }}" class="btn btn-success"><i class="fas fa-edit"></i> Edit Iframe</a>
                        <?php
                    }
                ?>
            </div>
        </form>
        <br>
<div class="modal fade" id="exampleModalScrollable" style="padding:0px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="padding:0px;">
      <div class="modal-content" style="padding:0px;">
        <div class="modal-body" style="padding:0px;margin:-10px;">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $video['v_trailer'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
@endsection