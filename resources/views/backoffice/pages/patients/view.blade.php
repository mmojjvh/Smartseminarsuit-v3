@extends('backoffice._layout.main')

@push('title',$title.' Details')

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
</style>
@endpush

@push('content')
<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->	  
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="me-auto">
                  <h4 class="page-title">Patient Details</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                            @if(in_array(auth()->user()->type,['super_user','admin']))
                            <li class="breadcrumb-item"><a href="{{route('backoffice.patients.index')}}"><i class="mdi mdi-account-outline"></i></a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">Patient Details</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>  

      <!-- Main content -->
      <section class="content">

          <div class="row">
              <div class="col-xl-6 col-12">
                  <div class="box">
                      <div class="box-body text-end min-h-150" style="background-image:url({{asset('images/profile-bg.jpg')}}); background-repeat: no-repeat; background-position: center;background-size: cover;">	
                      </div>						
                      <div class="box-body wed-up position-relative">
                          <div class="d-md-flex align-items-center">
                              <div class=" me-20 text-center text-md-start">
                                  @if($patient->getAvatar())
                                  <img src="{{asset($patient->getAvatar())}}" class="bg-lightest border-light rounded10 patient-avatar" alt="avatar" />	
                                  @endif
                              </div>
                              <div class="mt-40">
                                  <h4 class="fw-600 mb-5">&nbsp;</h4>
                                  <h2 class="fw-300 mb-5 mt-10">{{$patient->fname}} {{$patient->mname}} {{$patient->lname}}</h2>
                              </div>
                          </div>
                      </div>				
                  </div>
                  <div class="row">
                      <div class="col-xl-12 col-12">
                          <div class="box">
                              <div class="box-body box-profile">            
                                <div class="row">
                                  <div class="col-12">
                                      <div>
                                          <p><strong>Date of Birth</strong> :<span class="text-gray ps-10">{{ date('M d, Y',strtotime($patient->birthdate)) }}</span></p>
                                          <p><strong>Gender</strong> :<span class="text-gray ps-10">{{ ucfirst($patient->gender) }}</span></p>
                                          <p><strong>Email</strong> :<span class="text-gray ps-10">{{ $patient->user->email }}</span> </p>
                                          <p><strong>Phone</strong> :<span class="text-gray ps-10">{{ $patient->user->contact_number }}</span></p>
                                          <p><strong>Address</strong> :<span class="text-gray ps-10">{{ $patient->address }}</span></p>
                                      </div>
                                  </div>
                                  <!--
                                  <div class="col-12">
                                      <div class="pb-15">						
                                          <p class="mb-10"><strong>Social Profile</strong></p>
                                          <div class="user-social-acount">
                                              <button class="btn btn-circle btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></button>
                                              <button class="btn btn-circle btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></button>
                                              <button class="btn btn-circle btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></button>
                                          </div>
                                      </div>
                                  </div>
									<div class="col-12">
										<div>
											<div class="map-box">
												<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61361.61603803311!2d120.21937038299399!3d16.008256839477177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33915e5fe25ac4ad%3A0xdf7c5074eef5f9a8!2sLingayen%2C%20Pangasinan%2C%20Philippines!5e0!3m2!1sen!2sus!4v1681871317263!5m2!1sen!2sus" width="100%" height="175" frameborder="0" style="border:0" allowfullscreen></iframe>
											</div>
										</div>
									</div>
                                    -->
                                </div>
                                		
                                @if(in_array(auth()->user()->type,['super_user','admin']))	
                                <!-- <hr>	
                                <a href="{{route('backoffice.patients.edit', $patient->id)}}" class="btn btn-info me-5 mb-md-0 mb-5 btn-outline"><i class="ti-pencil-alt"></i> Edit Patient</a> -->
                                @else
                                &nbsp;
                                @endif
                              </div>
                              <!-- /.box-body -->
                            </div>
                      </div>
                  </div>					
              </div>
              
              <div class="col-xl-6 col-lg-6 col-12"> 
                    @include('backoffice._components.session_notif')
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $index => $appointment)
                                        <tr class="hover-primary">
                                            <td>{{$index+1}}</td>
                                            <td><strong>Service</strong> : {{ $appointment->service->name }} <br></td>
                                            <td>{{$appointment->status}}</td>
                                            <td><strong>Start</strong> : {{$appointment->start?date('M d, Y @ h:i a', strtotime($appointment->start)):'---'}} <br>
                                                <strong>End</strong> : {{$appointment->end?date('M d, Y @ h:i a', strtotime($appointment->end)):'---'}}</td>
                                            <td>												
                                                <div class="btn-group">
                                                    <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu">
                                                        @if(auth()->user()->type != 'patient')
                                                        <a class="dropdown-item" href="{{ route('backoffice.appointments.edit', $appointment->id) }}">Edit</a>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('backoffice.appointments.delete', $appointment->id) }}">Cancel</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
                    @if(auth()->check() AND auth()->user()->type == 'patient')
                    <a href="{{ route('backoffice.appointments.create') }}" class="btn btn-primary">
                        <i class="ti-calendar"></i> Request for Appointment
                    </a>
                    @endif

                    
                    <div class="box no-border no-shadow mt-20">
                        <div class="box-body overflow-auto">
                            <!-- the events -->
                            <div id="external-events">
                                <h3 class="fw-300">Treatment Records</h3>
                                <hr>
                                <table class="table border-no" id="example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Diagnosis</th>
                                            <th>Plan Summary</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($treatments as $index => $treatment)
                                        <tr class="hover-primary">
                                            <td>{{$index+1}}</td>
                                            <td>{{ $treatment->diagnosis }}</td>
                                            <td>{{ $treatment->plan_summary }}</td>
                                            <td>												
                                                <div class="btn-group">
                                                    <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('backoffice.patients.view_treatment', $treatment->id) }}">View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="hover-primary">
                                            <td colspan="4" class="text-center">No Treatment Records yet...</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    @if(auth()->check() AND auth()->user()->type != 'patient')
                    <a href="{{ route('backoffice.patients.create_treatment', $patient->id) }}" class="btn btn-primary">
                        <i class="ti-file"></i> Create Treatment Record
                    </a>
                    @endif
                </div> 
          </div>

      </section>
      <!-- /.content -->
    </div>
</div>

@if(auth()->user()->type == 'patient')
@include('commons.chatbot')
@endif

@endpush

@push('js')
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script>
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>	

<script src="{{asset('vet-clinic/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>	

<!-- Rhythm Admin App -->
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/patient-details.js')}}"></script>

<script src="{{asset('pages/js/moment.js')}}"></script>
<script src="{{asset('pages/js/chat.js')}}"></script>
<script type="module" src="{{asset('pages/js/firebase-chat.js')}}"></script>
@endpush