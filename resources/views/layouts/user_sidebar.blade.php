@section('sidebar')
  <style>
    .list-group-item.active {
      background: #aaa;
      border: #aaa;
    }
  </style>
  <div class="list-group">
    <a href="{{url('/user')}}" class="list-group-item list-group-item-action {{ Request::path() == 'user' ? 'active' : ''}}">
      <i class="fas fa-tachometer-alt"></i>
      Overview
    </a>
    <a href="{{url('/user/available')}}" class="list-group-item list-group-item-action  {{ Request::is('user/available/*') || Request::is('user/available') ? 'active' : '' }}">
      <i class="fas fa-box"></i>
      Available Items 
      <span class="badge badge-danger badge-pill float-right">
        {{$css_active_count + $epas_active_count}}
      </span>
    </a>

    <a href="{{url('/user/borrowed')}}" class="list-group-item list-group-item-action  {{ Request::is('user/borrowed/*') || Request::is('user/borrowed') ? 'active' : ''}} ">
      <i class="fas fa-hands"></i>
      Borrowed Items
      <span class="badge badge-danger badge-pill float-right">
        {{$borrowed_css_user + $borrowed_epas_user}}
      </span>
    </a>

    <a href="{{url('/user/returned')}}" class="list-group-item list-group-item-action  {{ Request::is('user/returned/*') || Request::is('user/returned') ? 'active' : ''}} ">
      <i class="fas fa-undo-alt"></i>
      Returned Items 
      <span class="badge badge-danger badge-pill float-right">
        {{$returned_css_user + $returned_epas_user}}
      </span>
    </a>

<!--     <a href="{{url('/user/account')}}" class="list-group-item list-group-item-action  {{ Request::is('/user/account/*') || Request::is('/user/account') ? 'active' : '' }}">
      <i class="fas fa-user"></i>
      User Account
    </a> -->
  </div>
@endsection