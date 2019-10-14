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
            @foreach($re as $row)
            <div class="col-md-6" style="margin-bottom:5px;">
                            <div class="box" style="padding:0px;margin-bottom:15px;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="bg" style="background: url('{{ $row['r_img'] }}');background-size:cover;border-radius:3px 0px 0px 3px;"><br><br><br><br><br><br><br></b></div>
                                    </div>
                                    <div class="col-md-9" style="color:white;">
                                    <h4 style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><b>{{ $row['r_name'] }}</b></h4>
                                        <?php
                                            if($row['r_aid'] == '-'){
                                                ?>
                                                    <a target="_blank" href="{{ url('') }}/{{ $row['r_vid'] }}/{{ str_replace(' ','-',$row['r_name']) }}" class="btn btn-success" style="border-radius:0px;"><i class="fas fa-play"></i> Watch</a>
                                                    <a href="{{ url('') }}/admin/edit/report/{{ $row['r_vid'] }}/{{ $row['r_id'] }}/movie" class="btn btn-warning" style="border-radius:0px;"><i class="fas fa-edit"></i> Edit</a>
                                                <?php
                                            }else{
                                                ?>
                                                    <a target="_blank" href="{{ url('') }}/watch/{{ $row['r_aid'] }}/{{ str_replace(' ','-',$row['r_name']) }}" class="btn btn-success" style="border-radius:0px;"><i class="fas fa-play"></i> Watch</a>
                                                    <a href="{{ url('') }}/admin/edit/report/{{ $row['r_vid'] }}/{{ $row['r_aid'] }}/{{ $row['r_id'] }}/anime" class="btn btn-warning" style="border-radius:0px;"><i class="fas fa-edit"></i> Edit</a>                                                    

                                                    <!-- {{ url('') }}/admin/edit/ep/{{ $row['r_aid'] }}/{{ $row['r_vid'] }} -->
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
            @endforeach
        </div>
    </div>
@endsection