@extends('layouts.app')
@include('layouts.user_sidebar')

@section('content')
<style>
    .card-text {
        font-size: 13px;
    }

    .alert-danger > p {
        margin-bottom:0px;
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
                    <a href="{{url('/user')}}">User Dashboard</a> / User Account
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert"></div>
                                <div class="alert alert-success" role="alert"></div>
                            </div>      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" value="{{$account->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Enter email" value="{{$account->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p><b>Note:</b> For password update,
                                    <a href="{{url('/password/reset')}}">click this link</a> to continue.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-right" id="update_account">Update</button>
                            </div>
                        </div>
                      </div>
                  </div>    
                </div>
            </div>
        </div>
    </div>

    
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var id = ""
        $('.alert').hide()
    })

    $(document).on('click','#update_account', function() {
        var url = "{{url('css_user/account')}}"
        var data = {
            name: $('#name').val(),
            email: $('#email').val(),
        }

        axios.put(url, data)
        .then(function (response) {
            if (response.data.code == 422) {
                    $('.alert-success').css('display','none')
                    $('.alert-danger').css('display','block')
                    var html = "";
                    $.each(response.data.error, function(x,y) {
                        html += '<p>&bullet; '+y+' </p>'
                    })

                    $('.alert-danger').html(html)
            } else {
                $('.alert-success').css('display','block')
                $('.alert-success').html('<p>&bullet; '+response.data.success+' </p>')
                $('.alert-danger').css('display','none')
                setTimeout(function() {
                    window.location.href = "{{url('css_user')}}"
                },100)

            }
        })
        .catch(function (error) {
        });
    })
</script>
@endsection
