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
        <a href="{{ url('') }}/admin/allvideo/list" class="btn btn-danger" style="margin-bottom:15px;"> <i class="fas fa-caret-square-left"></i> Back</a>
        
        <div class="row">
            <div class="col-md-2">
                <img src="{{ $edit['v_img'] }}" alt="" width="100%;" style="border-radius:2px;border-left:2px solid #ff4a3d;">
            </div>
            <div class="col-md-10">
                <div class="boxm" style="color:white;">
                    <h4>{{ $edit['v_name'] }}</h4>
                </div>
                <br>
                <div class="box" style="color:white;">
                    <?= $edit['v_detail'];?>
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
        <div class="box" style="color:white;">
            Iframe:
            <form action="{{ route('editmovie_start') }}" method="POST">
                @csrf
                <input type="hidden" name="m_id" value="{{ $movie[0]->m_id }}">
                <textarea name="m_iframe" style="background:#364064;border-color:#364064;color:white;" class="form-control" cols="30" rows="5">{{ $movie[0]->m_iframe }}</textarea>
                <br>
                <button class="btn btn-success"> Edit </button>
            </form>
        </div>
    </div>
    <br>
@endsection