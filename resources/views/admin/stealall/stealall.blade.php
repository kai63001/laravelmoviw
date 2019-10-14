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

            
        <div class="row">
            <div class="col-md-6" style="color:white;">
             
                <br>
                <h4><center>Steal All Anime</center></h4>
                <br>
                <a href="{{ url('') }}/admin/steal/animehdzero" style="text-decoration:none;color:white;">
                    <div class="box">
                        <br>
                        <h1><center>Anime HD Zero</center></h1>
                        <br>
                    </div>
                    <br>
                    @if(session('successhdzero'))
                    <div class="" style="color:white;background:#22bb33;padding:15px;">
                        {{ session('successhdzero') }}
                        
                    </div>
                    @endif
                    <br>
                </a>
                
            </div>
            <div class="col-md-6" style="color:white;">
                <br>
                <h4><center>Steal Movie</center></h4>
                <br>
                <a href="{{ url('') }}/admin/steal/imovie" style="text-decoration:none;color:white;">
                    <div class="box">
                        <br>
                        <h1><center>Imovie-hd</center></h1>
                        <br>
                    </div>
                    <br>
                    @if(session('successimovie'))
                    <div class="" style="color:white;background:#22bb33;padding:15px;">
                        {{ session('successimovie') }}
                        
                    </div>
                    @endif
                    <br>
                </a>
            </div>
        </div>
    </div>
@endsection