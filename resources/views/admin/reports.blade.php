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
                    <a href="{{url('/admin')}}">Admin Dashboard</a> / Reports
                </div>
                <div class="card-body">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <select class="form-control" id="filter_report">
                                    <option disabled selected>Filter reports</option>
                                    <option value="borrowed_css">Borrowed CSS Items</option>
                                    <option value="returned_css">Returned CSS Items</option>
                                    <option value="new_css">New CSS Item</option>
                                    <option value="good_css">Good CSS Item</option>
                                    <option value="defective_css">Defective CSS Item</option>
                                    <option disabled>-----------------------------------</option>
                                    <option value="borrowed_epas">Borrowed EPAS Items</option>
                                    <option value="returned_epas">Returned EPAS Items</option>
                                    <option value="new_epas">New EPAS Item</option>
                                    <option value="good_epas">Good EPAS Item</option>
                                    <option value="defective_epas">Defective EPAS Item</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button id="generate_report" class="btn btn-danger"> 
                                <i class="fas fa-file-pdf"></i>
                                Generate PDF Report
                            </button>
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

    $(document).on('click', '#generate_report', function() {
        var url = "{{url('admin/reports/download_pdf')}}/"+$('#filter_report').val()
       
        axios.get(url)
        .then(function (response) {
        })
        .catch(function (error) {
        });
    })
   
</script>
@endsection
