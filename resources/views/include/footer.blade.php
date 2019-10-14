<footer style="background:#1b1b1b;color:white;padding:25px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1>{{ $setting['s_title'] }}</h1>
                    {{ $setting['s_des'] }}
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    @foreach($tag as $row)
                        <a class="badge badge-primary" style="background:#1ba0e2;" href="{{ url('') }}/tags/video/{{  $row['t_name'] }}">{{ $row['t_name'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
</footer>
<div style="background:black;color:white;"><center>© Copyright 2019 Kuro-Dev</center></div>