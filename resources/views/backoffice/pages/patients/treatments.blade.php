@extends('backoffice._layout.main')

@push('title','Treatment Record')

@push('css')
<style>
    .underline-text{
        text-decoration: underline;
    }
    .table, td{
        border: 1px solid #dee2e6;
    }
    .input-sm{
        height: 25px;
        border: none;
        padding: 0px!important;
    }
</style>
@endpush

@push('content')
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->	  
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">Treatment Record</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Treatment Record</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('backoffice._components.session_notif')
                    <form action="" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box">
                        <div class="box-header with-border text-center">
                            <h4 class="box-title">TREATMENT RECORD</h4>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                @include('backoffice.pages.patients.treatment_form')
                                @include('backoffice.pages.patients.treatment_table')
                            </div>
                        </div>
                    </div>
                    @if(auth()->check() AND auth()->user()->type != 'patient')
                    <input class="btn btn-primary" type="submit" name="submit" value="SAVE">
                    @endif
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endpush

@push('js')
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script>
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>	
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_plugins/iCheck/icheck.min.js')}}"></script>

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>

<script src="{{asset('vet-clinic/main/js/pages/advanced-form-element.js')}}"></script>

<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endpush