@extends('layouts.app')
@include('layouts.admin_sidebar')

@section('content')
<style>
    .card-text {
        font-size: 13px;
    }
    
</style>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @yield('sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                  <a href="{{url('/admin')}}">Admin Dashboard</a> / Overview
                </div>
                <div class="card-body">
                    <div class="card-deck mb-3">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$css_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="{{url('admin/css')}}">CSS ITEMS</a>
                          </small></p>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$borrowed_css_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="#">BORROWED CSS ITEMS</a>
                          </small></p>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$defective_css_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="#">DEFECTIVE CSS ITEMS</a>
                          </small></p>
                        </div>
                      </div>
                       <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$css_user_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="#">CSS USERS ACCOUNT</a>
                          </small></p>
                        </div>
                      </div>
                    </div>
                    <div class="card-deck mb-3">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$epas_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="#">EPAS ITEMS</a>
                          </small></p>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$borrowed_epas_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="#">BORROWED EPAS ITEMS</a>
                          </small></p>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$defective_epas_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="#">DEFECTIVE EPAS ITEMS</a>
                          </small></p>
                        </div>
                      </div>
                       <div class="card">
                        <div class="card-body">
                          <h5 class="card-title text-center"><b>{{$epas_user_count}}</b></h5>
                          <p class="card-text"></p>
                          <p class="card-text text-center"><small class="text-muted">
                              <a href="#">EPAS USERS ACCOUNT</a>
                          </small></p>
                        </div>
                      </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
