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
        <a href="{{ url('') }}/admin/" class="btn btn-danger" style="margin-bottom:15px;"> <i class="fas fa-caret-square-left"></i> Back</a>
        
        <div class="row">
           <div class="col-md-6">
                    @if(session('success'))
                    <div class="" style="color:white;background:#22bb33;padding:15px;">
                        {{ session('success') }}
                    </div>
                    <br>
                    @endif
                <div class="box" style="color:white;">
                    <strong><h4>Script</h4></strong>
                    <br>
                    <form action="{{ route('savescript') }}" method="POST">
                        @csrf
                        Header:
                        <textarea name="s_header" id="" class="form-control" style="background:#364064;border-color:#364064;color:white;" cols="10" rows="5">{{ $setting['s_header'] }}</textarea>
                        Body:
                        <textarea name="s_body" id="" class="form-control" style="background:#364064;border-color:#364064;color:white;" cols="10" rows="5">{{ $setting['s_body'] }}</textarea>
                        <br>
                        <button style="float:right;" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        <br><br>
                    </form>
                    
                </div>
           </div>
           <div class="col-md-6">
                    @if(session('successads'))
                    <div class="" style="color:white;background:#22bb33;padding:15px;">
                        {{ session('successads') }}
                    </div>
                    <br>
                    @endif
                <div class="box" style="color:white;">
                    <strong><h4>Advertisement</h4></strong>
                    @foreach($ads as $row)
                        <div class="box" style="background:#1a184f;">
                           <div class="row">
                                <div class="col-md-11">
                                    {{ $row['ad_name'] }}
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ url('') }}/admin/delete/ads/{{ $row['ad_id'] }}"><i class="fas fa-times" style="color:red;"></i></a>
                                </div>
                           </div>
                        </div>
                    @endforeach
                    <form action="{{ route('saveads') }}" method="POST">
                        @csrf
                        Name :
                        <input name="ad_name" style="background:#364064;border-color:#364064;color:white;" type="text" class="form-control" required>
                        Image :
                        <input name="ad_img" style="background:#364064;border-color:#364064;color:white;" type="text" class="form-control" required>
                        Url :
                        <input name="ad_url" style="background:#364064;border-color:#364064;color:white;" type="text" class="form-control" required>
                        <br>
                        <button style="float:right;" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        <br><br>
                    </form>
                </div>
                <br>
                <a href="{{ url('') }}/changePassword" class="btn btn-dark">Change Password</a>
           </div>
        </div>
    </div>
@endsection