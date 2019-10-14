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
        <div class="row">
            <div class="col-md-8">
                <a href="{{ url('') }}/admin" class="btn btn-danger"> <i class="fas fa-caret-square-left"></i> Back</a>
            </div>
            <div class="col-md-4">
                <form action="{{ route('allvideosearch') }}" method="GET">
                    @if($searched == "ok")
                        <input type="text" name="search" class="form-control" style="background:#364064;border:0px;color:white;" >
                    @else
                        <input type="text" name="search" class="form-control" style="background:#364064;border:0px;color:white;" value="{{ $searched }}">
                    @endif
                </form>
            </div>
        </div>
        <div class="row">
           <div class="col-md-12">
           <br>
            <div class="row">
                @if($search)
                    @foreach($video as $row)
                        <div class="col-md-6" style="margin-bottom:5px;">
                            <div class="box" style="padding:0px;margin-bottom:15px;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="bg" style="background: url('{{ $row['v_img'] }}');background-size:cover;border-radius:3px 0px 0px 3px;"><br><br><br><br><br><br><br></b></div>
                                    </div>
                                    <div class="col-md-9" style="color:white;">
                                        <h4 style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><b>{{ $row['v_name'] }}</b></h4>
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
                                                    <a href="{{ url('') }}/admin/backupfind/{{ $row['v_id'] }}" class="btn btn-info" style="border-radius:0px;"><i class="fas fa-save"></i> Ep</a>

                                                <?php
                                            }else{
                                                ?>
                                                    <a href="{{ url('') }}/admin/movie/backup/{{ $row['v_id'] }}" class="btn btn-info" style="border-radius:0px;"><i class="fas fa-save"></i> Backup</a>
                                                <?php
                                            }
                                        ?>
                                        <a href="{{ url('') }}/admin/edit/video/{{ $row['v_id'] }}" class="btn btn-warning" style="border-radius:0px;"><i class="fas fa-edit"></i> Edit</a>
                                        <a id="delete{{ $row['v_id'] }}" class="btn btn-danger" style="border-radius:0px;"><i class="fas fa-trash"></i> Delete</a>

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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else

                @endif
                
            </div>
            <br>
            {{ $video->links() }}
           </div>
        </div>
    </div>
@endsection