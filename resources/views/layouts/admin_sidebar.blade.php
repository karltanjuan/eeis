@section('sidebar')
  <style>
    .list-group-item.active {
      background: #aaa;
      border: #aaa;
    }
  </style>
  <div class="list-group">
    <a href="{{url('/admin')}}" class="list-group-item list-group-item-action {{ Request::path() == 'admin' ? 'active' : ''}}">
      <i class="fas fa-tachometer-alt"></i>
      Overview <!-- <span class="badge badge-danger badge-pill float-right">8</span> -->
    </a>
    <a href="{{url('/admin/borrow')}}" class="list-group-item list-group-item-action  {{ Request::is('admin/borrow/*') || Request::is('admin/borrow') ? 'active' : ''}} ">
      <i class="fas fa-hands"></i>
      Borrow Items <span class="badge badge-danger badge-pill float-right">{{$borrowed_css_count + $borrowed_epas_count}}</span>
    </a>
    <a href="{{url('/admin/css')}}" class="list-group-item list-group-item-action  {{ Request::is('admin/css/*') || Request::is('admin/css') ? 'active' : ''}} ">
      <i class="fas fa-box"></i>
      CSS Inventory <span class="badge badge-danger badge-pill float-right">{{ $css_count }}</span>
    </a>
    <a href="{{url('/admin/epas')}}" class="list-group-item list-group-item-action  {{ Request::is('admin/epas/*') || Request::is('admin/epas') ? 'active' : '' }}">
      <i class="fas fa-box"></i>
      EPAS Inventory <span class="badge badge-danger badge-pill float-right">{{ $epas_count }}</span>
    </a>
    <a href="{{url('/admin/users')}}" class="list-group-item list-group-item-action  {{ Request::is('admin/users/*') || Request::is('admin/users') ? 'active' : '' }}">
      <i class="fas fa-user"></i>
      Users Account <span class="badge badge-danger badge-pill float-right">{{ $user_count }}</span>
    </a>
    <a href="{{url('/admin/reports')}}" class="list-group-item list-group-item-action  {{ Request::path() == 'admin/reports' ? 'active' : ''}}">
      <i class="fas fa-print"></i>
      Print Reports
    </a>
    <a href="{{url('/admin/logs')}}" class="list-group-item list-group-item-action  {{ Request::path() == 'admin/logs' ? 'active' : ''}}">
      <i class="fas fa-scroll"></i>
      Activity Logs <span class="badge badge-danger badge-pill float-right">{{ $admin_log_count }}</span>
    </a>
  </div>
@endsection