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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection
@section('body')
<br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="control" style="color:white;">
                    <h2><b>Control</b></h2>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Movie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Anime</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Series</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-open-tab" data-toggle="pill" href="#pills-open" role="tab" aria-controls="pills-open" aria-selected="false">Menu</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                          @if(session('success'))
                            <div class="alert alert-success" style="background:#75B267;border-color:#75B267;color:white;">
                                {{ session('success') }}
                                <br>
                                <a href="admin/movie/backup/{{ session('m_id') }}" class="btn btn-danger">Add Backup</a>
                            </div>
                          @endif
                          @if(session('successanime'))
                            <div class="alert alert-success" style="background:#00c220;border-color:#00c220;color:white;">
                                <span style="color:white;">{{ session('successanime') }}</span>
                                <br>
                                <a href="admin/anime/backup/{{ session('a_id') }}" class="btn btn-danger">Add Backup</a>
                            </div>
                          @endif
                          @if(session('backup'))
                           <script>
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            })

                            Toast.fire({
                                type: 'success',
                                title: 'Add Backup in successfully'
                            })
                           </script>
                          @endif
                            <div class="boxm" style="">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="https://image.flaticon.com/icons/svg/1466/1466129.svg" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        Name of Movie:
                                        <input id="find_movie" type="text" class="form-control" style="background:#364064;border-color:#364064;color:white;">
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button id="btn_find_movie" class="btn btn-block btn-primary" style="background:#6C58D5;border-color:#6C58D5;"><i class="fas fa-search"></i></button>
                                        <script>
                                            $('#btn_find_movie').click(function(){
                                                find_movie = $('#find_movie').val();
                                                if(find_movie != ""){
                                                    $('#btn_find_movie').html('<i class="fas fa-circle-notch fa-spin"></i>');
                                                    window.location='admin/find-movie/'+find_movie;
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="boxm" style="border-left:3px solid #EB7A9F;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="https://image.flaticon.com/icons/svg/1466/1466114.svg" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        Name of Anime:
                                        <input type="text" id="find_anime" class="form-control" style="background:#364064;border-color:#364064;color:white;">
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button class="btn btn-block btn-primary" id="btn_find_anime" style="background:#EB7A9F;border-color:#EB7A9F;"><i class="fas fa-search"></i></button>
                                        <script>
                                            $('#btn_find_anime').click(function(){
                                                find_anime = $('#find_anime').val();
                                                if(find_anime != ""){
                                                    $('#btn_find_anime').html('<i class="fas fa-circle-notch fa-spin"></i>');
                                                    window.location='admin/find-anime/'+find_anime;
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="boxm" style="border-left:3px solid #75B267;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="https://image.flaticon.com/icons/svg/1466/1466117.svg" width="100%" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        Name of Series:
                                        <input type="text" class="form-control" id="find_series" style="background:#364064;border-color:#364064;color:white;">
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button class="btn btn-block btn-primary" id="btn_find_series" style="background:#75B267;border-color:#75B267;"><i class="fas fa-search"></i></button>
                                    </div>
                                    <script>
                                            $('#btn_find_series').click(function(){
                                                find_series = $('#find_series').val();
                                                if(find_series != ""){
                                                    $('#btn_find_series').html('<i class="fas fa-circle-notch fa-spin"></i>');
                                                    window.location='admin/find-series/'+find_series;
                                                }
                                            });
                                        </script>
                                </div>
                            </div>
                      </div>
                      <div class="tab-pane fade" id="pills-open" role="tabpanel" aria-labelledby="pills-open-tab">
                            <div class="boxm" style="border-left:3px solid #ff7e21;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('') }}/admin/stealall/list" style="text-decoration:none;color:white;">
                                            <div class="box" style="border:0px;background:#FA7921;text-align:center;height:105px;">
                                            <br>
                                                <h3>Steal All</h3>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ url('') }}/admin/allvideo/list" style="text-decoration:none;color:white;">
                                            <div class="box" style="border:0px;background:#E55934;text-align:center;height:105px;">
                                            <br>
                                                <h3>All Video</h3>
                                            </div>
                                        </a>
                                    </div>
                                    
                                    <div class="col-md-9" style="margin-top:15px;">
                                        <a href="{{ url('') }}/admin/os/setting" style="text-decoration:none;color:white;">
                                            <div class="box" style="border:0px;background:#3A7B96;text-align:center;height:105px;">
                                            <br>
                                                <h3>Setting</h3>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="margin-top:15px;">
                                        <a href="{{ url('') }}/logout" style="text-decoration:none;color:white;">
                                            <div class="box" style="border:0px;background:#ff3030;text-align:center;height:105px;">
                                            <br>
                                                <i class="fas fa-sign-out-alt fa-2x"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>
                {{-- control --}}
                <br>
                
                <div id="setting" style="color:white;">
                    <h2>Settings</h2>
                    @if(session('successedit'))
                            <div class="" style="color:white;background:#22bb33;padding:15px;">
                                {{ session('successedit') }}
                            </div>
                            <br>
                        @endif
                        <div class="box">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " id="pills-setting-tab" data-toggle="pill" href="#pills-setting" role="tab" aria-controls="pills-setting" aria-selected="true">Option</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-tag-tab" data-toggle="pill" href="#pills-tag" role="tab" aria-controls="pills-tag" aria-selected="false">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-advance-tab" data-toggle="pill" href="#pills-advance" role="tab" aria-controls="pills-advance" aria-selected="false">Advance Option</a>
                        </li>
                        </ul>
                       
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade " id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
                                <div class="container">
                                    <div class="bgform">
                                        <form action="{{ route('dashboard') }}" method="POST">
                                            @csrf
                                            Title :
                                            <input type="text" name="s_title" class="form-control" style="background:#364064;border-color:#364064;color:white;" value="{{ $setting['s_title'] }}" required>
                                            Description:
                                            <textarea name="s_des" id="" cols="10" rows="3" class="form-control" style="background:#364064;border-color:#364064;color:white;">{{ $setting['s_des'] }}</textarea>
                                            Keywords :
                                            <textarea name="s_keyword" id="" cols="10" rows="3" class="form-control" style="background:#364064;border-color:#364064;color:white;">{{ $setting['s_keyword'] }}</textarea>
                                            <br>
                                            <button type="submit" class="btn btn-primary" style="float:right;"><i class="fas fa-save"></i> Save </button>
                                            <br><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="pills-tag" role="tabpanel" aria-labelledby="pills-tag-tab">
                                <div class="container">
                                    @if (session('tags'))
                                        <script>
                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'top-end',
                                                showConfirmButton: false,
                                                timer: 3000
                                            })

                                            Toast.fire({
                                                type: 'success',
                                                title: '{{ session("tags") }}'
                                            })
                                        </script>
                                    @endif
                                    <div class="bgform">
                                        @foreach ($tag as $row)
                                            <span class="badge badge-primary" style="background:#6C58D5;">{{ $row['t_name'] }} <a href="{{ url('') }}/admin/delete/tags/{{ $row['t_id'] }}" style="text-decoration:none;color:white;"><i class="fas fa-times"></i></a></span>                                            
                                        @endforeach
                                        <hr style="background:#3e3082;">
                                        <form action="{{ route('addtags') }}" method="POST">
                                            Tags Name :
                                            @csrf
                                            <input type="text" name="t_name" class="form-control" style="background:#3e3082;border-color:#3e3082;color:white;" placeholder="ผจญ" required>
                                            <br>
                                            <button type="submit" class="btn btn-primary" style="background:#3e3082;border-color:#3e3082;float:right;"><i class="fas fa-save"></i> Save</button>
                                            <br>
                                            <br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-advance" role="tabpanel" aria-labelledby="pills-advance-tab">
                                <div class="container">
                                    <div class="bgform">
                                        <form action="{{ route('advance') }}" method="POST">
                                            @csrf
                                            Background : <font size="1px">(ถ้าต้องการให้เป็นรูป "url('url/img.jpg')")</font>
                                            <input type="text" name="s_bg" class="form-control" style="background:#364064;border-color:#364064;color:white;" value="{{ $setting['s_bg'] }}" required>
                                            Main Color:
                                            <input type="text" name="s_maincolor" class="form-control" style="background:#364064;border-color:#364064;color:white;" value="{{ $setting['s_maincolor'] }}" required>
                                            Fanpage:
                                            <input type="text" name="s_fanpage" class="form-control" style="background:#364064;border-color:#364064;color:white;" value="{{ $setting['s_fanpage'] }}" required>
                                            Player Cover: (ถ้าต้องการเอา cover ออกให้ ใส่ -)
                                            <input type="text" name="s_coverplayer" class="form-control" style="background:#364064;border-color:#364064;color:white;" value="{{ $setting['s_coverplayer'] }}" required>
                                            Player Ads: (ถ้าต้องการเอา Ads ออกให้ ใส่ -)
                                            <input type="text" name="s_adsplayer" class="form-control" style="background:#364064;border-color:#364064;color:white;" value="{{ $setting['s_adsplayer'] }}" required>
                                            <br>
                                            <button type="submit" class="btn btn-primary" style="float:right;"><i class="fas fa-save"></i> Save </button>
                                            <br><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- จบ col-md-7 : 1 --}}
            <div class="col-md-6">
                <div id="report" style="color:white;">
                    <h2>Status</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="boxm" style="border:0px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);" >
                                <h3>View</h3>
                                <div align="right">{{ number_format($view_all) }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url('') }}/admin/show/report" style="text-decoration:none;color:white;">
                                <div class="boxm" style="border:0px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
                                    <h3>Report</h3>
                                    <div align="right">{{ $report }}</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url('') }}/admin/allvideo/list" style="text-decoration:none;color:white;">
                                <div class="boxm" style="border:0px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
                                    <h3>Video</h3>
                                    <div align="right">{{ number_format($allvideo) }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <br>
                <div id="lastupdate" style="color:white;">
                    <h2>Last Update</h2>
                    @foreach ($video_lastupdate as $row)
                        <div class="box" style="padding:0px;margin-bottom:15px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="bg" style="background: url('{{ $row['v_img'] }}');background-size:cover;border-radius:3px 0px 0px 3px;"><br><br><br><br><br><br><br></b></div>
                                </div>
                                <div class="col-md-9">
                                    <h4><b>{{ $row['v_name'] }}</b></h4>
                                    <a target="_blank" href="{{ url('') }}/{{ $row['v_id'] }}/{{ str_replace(' ','-',$row['v_name']) }}" class="btn btn-success" style="border-radius:0px;"><i class="fas fa-play"></i> Watch</a>
                                    <?php
                                        if($row['v_movie'] == "0"){
                                            ?>
                                                <!-- <a href="{{ url('') }}/admin/addvideoanime/{{ $row['v_id'] }}" class="btn btn-dark"><i class="fas fa-edit"></i> Add More Ep</a> -->

                                            <?php
                                        }else{
                                            ?>
                                            <!-- <a href="{{ url('') }}/admin/seriesvideo/{{ $row['v_id'] }}" class="btn btn-dark"><i class="fas fa-edit"></i> Add More Ep</a> -->

                                        <?php
                                        }
                                    ?>
                                    <?php
                                        if($row['v_movie'] != "1"){
                                            ?>
                                                <a style="border-radius:0px;" href="{{ url('') }}/admin/backupfind/{{ $row['v_id'] }}" class="btn btn-info"><i class="fas fa-save"></i> Ep</a>

                                            <?php
                                        }else{
                                            ?>
                                                <a style="border-radius:0px;" href="{{ url('') }}/admin/movie/backup/{{ $row['v_id'] }}" class="btn btn-info"><i class="fas fa-save"></i> Backup</a>

                                            <?php
                                        }
                                    ?>
                                    <a style="border-radius:0px;" href="{{ url('') }}/admin/edit/video/{{ $row['v_id'] }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                    <a style="border-radius:0px;" id="delete{{ $row['v_id'] }}" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('#delete{{ $row["v_id"] }}').click(function(){
                                const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                    cancelButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                                })

                                swalWithBootstrapButtons.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true
                                }).then((result) => {
                                if (result.value) {
                                    swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                    window.location = '{{ url("") }}/admin/movie/delete/{{ $row["v_id"] }}';
                                } else if (
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    'Your imaginary file is safe :)',
                                    'error'
                                    )
                                }
                                })
                            });
                        </script>
                    @endforeach
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection