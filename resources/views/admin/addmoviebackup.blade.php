
@extends('master')
@section('title','Admin - Dashboard')
@section('header')
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <style>
        html,body{
            font-family: 'Kanit', sans-serif !important;
            /* background:#2B3451 !important; */
            background:  !important;
            background-position: center !important;
            background-size:cover !important;
            background-repeat: no-repeat !important;
            height: 100%;
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
@endsection
@section('body')

<div id="bg" style="background:rgba(43,52,81);background-size:cover;height:100%;background-attachment:fixed;">
<br><br>
    <div class="container" style="color:white;">
        <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
            <h4>{{ $movie['v_name'] }} [BACKUP]</h4>
        </div>
        <br>
        <form action="{{ route('addbackup_movie') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        <img loading="lazy" src="{{ $movie['v_img'] }}" alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="cardbox" style="background:#1b2a4d;border-radius:4px;padding:15px;">
                        <input type="hidden" name="mb_vid" value="{{ $v_id }}">
                        Name :
                        <input type="text" class="form-control" name="mb_name" style="background:#284485;border-color:#284485;color:white;" value="สำรอง">
                        <br>

                        Ifream  [BACKUP]:
                        <textarea class="form-control" style="background:#284485;border-color:#284485;color:white;" name="mb_iframe" id="" cols="30" rows="10" required></textarea>
                        <br>
                        <span id="show" style="color:black !important;"></span>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>
                        <span id="find" class="btn btn-danger"><i class="fas fa-search"></i> Movie iframe</span>
                    </div>
                </div>
            </div>

            
        </form>
        <script>
            $('#find').click(function(){

                $('#find').text('Searching..');

                url = "{{ url('') }}/admin/searchmovie/{{ str_replace(' ','+',$movie['v_name']) }}";
                
                XmlSearchMovie = new XMLHttpRequest();
                XmlSearchMovie.open('GET',url,true);
                XmlSearchMovie.send();
                XmlSearchMovie.onreadystatechange = function(){
                    if(XmlSearchMovie.readyState == 4){
                        $('#show').html(this.responseText);
                        $('#find').text('Success!!');

                    }
                }
            });
        </script>
    </div>
</div>
 
@endsection