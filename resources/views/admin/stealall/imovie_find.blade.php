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

        ::placeholder {
            color: #c9c9c9 !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection
@section('body')
<br>

    <div class="container">
        <a href="{{ url('') }}/admin/stealall/list" class="btn btn-danger"> <i class="fas fa-caret-square-left"></i> Back</a>

        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="box" style="color:white;">
                    Steal  <a target="_blank" href="https://www.imovie-hd.com/">Imovie-Hd</a> :
                    <br>
                    <input type="text" id="url" class="form-control" style="background:#c71e2f;border-color:#c71e2f;color:white;" placeholder="real-steel-ศึกหุ่นเหล็กกำปั้นถล่">
                    <br>
                    <button id="start" class="btn btn-danger"> Start </button>
                    <script>
                         $('#start').click(function(){
                             url = $('#url').val();
                             if(url != ""){
                                 $('#start').html('<i class="fas fa-circle-notch fa-spin"></i>');
                                 window.location='{{ url('') }}/admin/steal/imovie/'+url;
                             }
                         });
                    </script>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection