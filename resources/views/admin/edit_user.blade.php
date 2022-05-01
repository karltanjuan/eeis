@extends('layouts.app')
@include('layouts.admin_sidebar')

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
                    <a href="{{url('/admin')}}">Admin Dashboard</a> / <a href="{{url('/admin/users')}}">Users</a> / Edit User
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert"></div>
                            <div class="alert alert-success" role="alert"></div>
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label ">{{ __('Name') }}</label>
                            <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password" class=col-form-label ">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password-confirm" class=" col-form-label ">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="update_item" class="btn btn-primary float-right">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.alert').hide();
    })

    $(document).on('click','#update_item', function() {
        var url = "{{url('admin/users')}}/{{$user->id}}"

        var data = {
            // _token: "{{ csrf_token() }}",
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password-confirm').val()
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
                    window.location.href = "{{url('admin/users')}}"
                },100)

            }
        })
        .catch(function (error) {
        });
    })
</script>
@endsection
