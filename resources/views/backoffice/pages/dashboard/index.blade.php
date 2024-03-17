@extends('backoffice._layout.main')

@push('title','Dashboard')

@push('css')
<link class="main-stylesheet" href="{{asset('pages/css/chat.css')}}" rel="stylesheet" type="text/css" />
<style>
    .col-xs-2 {
        width: 16.66666667%;
    }
    .col-xs-6 {
        width: 50%;
    }
    .col-xs-10 {
        width: 83.33333333%;
    }
    .modal-content{
        max-width: 750px!important;
    }
</style>
@endpush

@push('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <div class="container-full">
      <!-- Main content -->
      <section class="content">
          <div class="row">
            @if(auth()->user()->type != 'patient')
            <div class="col-xl-3 col-md-6 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-warning"><i class="mdi mdi-account"></i></h1>	
                            <h2>{{ $patientCount }}</h2>	
                            <span class="badge badge-pill badge-warning px-10 mb-10">Total Patients</span>						
                        </div>					
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-success"><i class="mdi mdi-calendar"></i></h1>	
                            <h2>{{ $appointmentsCount }}</h2>	
                            <span class="badge badge-pill badge-success px-10 mb-10">Total Appointments</span>						
                        </div>					
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-danger"><i class="mdi mdi-check"></i></h1>	
                            <h2>{{ $newPatientCount }}</h2>	
                            <span class="badge badge-pill badge-danger px-10 mb-10">Today's New Registered Patient</span>						
                        </div>					
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-40 text-primary mb-20">₱</h1>
                            <h2 class="fs-20 mb-20">Earning Summary Report</h2>	
                            <div class="row">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="date" name="start" class="form-control" id="start" oninput="appointment()" placeholder="" required/>
                                        </div>
                                        <div class="col-6">
                                            <input type="date" name="end" class="form-control" id="end" oninput="appointment()" placeholder="" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modal-fill-earning">View</button>
                                </div>
                            </div>
                        </div>					
                    </div>
                </div>
            </div>
            @endif
          </div>	
          <div class="row">
            <div class="col-md-12">
                <div class="box no-border no-shadow">
                    <div class="box-body overflow-auto">
                        <!-- the events -->
                        <div id="external-events">
                            <h3 class="fw-300">Appointments</h3>
                            <hr>
                            <table class="table border-no" id="example1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Information</th>
                                        <th>Status</th>
                                        <th>Schedule</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($appointments as $index => $appointment)
                                    @if((auth()->user()->type == 'patient' AND ($appointment->patient_id? $appointment->patient->user->id == auth()->user()->id: false)) OR auth()->user()->type != 'patient')
                                    <tr class="hover-primary">
                                        <td>{{$index+1}}</td>
                                        <td>
                                            @if($appointment->patient_id)
                                            <strong>Patient</strong> : {{$appointment->patient->user->name}} <br>
                                            @else
                                            <strong>Patient</strong> : {{$appointment->name}} <br>
                                            @endif
                                            <strong>Service</strong> : {{ $appointment->service->name }} </td>
                                        <td>{{$appointment->status}}</td>
                                        <td>
                                            <strong>Start</strong> : {{$appointment->start?date('M d, Y @ h:i a', strtotime($appointment->start)):'---'}} <br>
                                            <strong>End</strong> : {{$appointment->end?date('M d, Y @ h:i a', strtotime($appointment->end)):'---'}}
                                        </td>
                                    </tr>
                                    @endif
                                    @empty
                                    <tr class="hover-primary">
                                        <td colspan="4" class="text-center">No Appointments yet...</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('backoffice.appointments.index') }}" class="btn btn-primary">
                    Go to Appointments <i class="ti-arrow-right"></i>
                </a>
            </div>
          </div>		
      </section>
      <!-- /.content -->
    </div>
</div>
<div class="modal modal-fill fade" data-backdrop="false" id="modal-fill-earning" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="modal-title-earning">No Month Selected</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Service</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody class="table-data-earning">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Payment</th>
                                <td></td>
                                <td></td>
                                <th>₱ <span id="total-payment-earning">00</span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary btn-outline btn-sm" target="_blank" id="download-earning"><i class="fa fa-download"></i> Download</a>
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
@if(auth()->user()->type == 'patient')
@include('commons.chatbot')
@endif
@endpush

@push('js')
<!-- Vendor JS -->
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script>
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>

<script src="{{asset('vet-clinic/assets/vendor_components/date-paginator/moment.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/date-paginator/bootstrap-datepaginator.min.js')}}"></script>

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/dashboard.js')}}"></script>

<script src="{{asset('pages/js/moment.js')}}"></script>
<script src="{{asset('pages/js/chat.js')}}"></script>
<script type="module" src="{{asset('pages/js/firebase-chat.js')}}"></script>
<script>

    function appointment(){
        var start = $('#start').val()?$('#start').val():'(Please select Start Date)';
        var end = $('#end').val()?$('#end').val():'(Please select End Date)';

        console.log('Im change');

        $("#download-earning").attr("href", "{!! route('backoffice.download') !!}/"+start+"/"+end);
        $("#modal-title-earning").text("Earning Summary Report of "+start+" - "+end);

        $.ajax({
            type: "POST",
            url: "{!! route('backoffice.viewReport') !!}",
            data: { _start : start , _end : end , _token : "{{csrf_token()}}"  },
            dataType: "json",
            async: true,
            success: function(data){
                console.log(data.datas);
                $(".table-data-earning").empty();
                if(data.datas.services.length > 0){
                    data.datas.services.forEach(function (service) {
                        $(".table-data-earning").append(
                            `
                            <tr>
                                <td>${service.date}</td>
                                <td>${service.patient_name}</td>
                                <td>${service.service}</td>
                                <td>₱ ${service.price}</td>
                            </tr>
                            `
                        );
                    });
                }else{
                    $(".table-data-earning").append(
                        `
                        <tr>
                            <td colspan="4" class="text-center">No data...</td>
                        </tr>
                        `
                    );
                }
                $("#total-payment-earning").text(data.datas.total_payments);
            },
            error: function(error){
                console.log(error);
            }
        });
    };
</script>
@endpush
