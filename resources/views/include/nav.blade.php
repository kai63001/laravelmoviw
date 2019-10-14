<div class="fixed-top">
<div style="border-top:4px solid {{ $setting['s_maincolor'] }};"></div>
<nav class="navbar navbar-expand-lg navbar-light " style="background:white;color:black;    box-shadow: 0 1px 3px 0 rgba(27,27,27,.1), 0 4px 8px 0 rgba(27,27,27,.1);">
    <div class="container">
        <a class="navbar-brand" href="{{ url('') }}">{{ $setting['s_title'] }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ url('') }}">หน้าแรก <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('') }}/วิดีโอทั้งหมด">วิดีโอทั้งหมด</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('') }}/หนังทั้งหมด">หนังทั้งหมด</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('') }}/อนิเมะทั้งหมด">อนิเมะทั้งหมด</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('') }}/ซีรีย์ทั้งหมด">ซีรีย์ทั้งหมด</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" action="{{ route('searcher') }}" method="GET">
              <input type="text" class="form-control" name="search" placeholder="ค้าหา.." value="">
          </form>
        </div>
      </div>
  </nav>
</div>