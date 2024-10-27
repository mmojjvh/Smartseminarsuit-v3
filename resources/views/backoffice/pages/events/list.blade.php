@extends('backoffice._layout.main')

@push('title',$title.' List')

@include('commons.customfonts')
<link rel="stylesheet" href="{{ URL::asset('custom/customfonts.css') }}">

@push('css')
  <style type="text/css">
    .overflow-visible { 
      overflow: visible;
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
                  <h4 class="page-title">{{$title}}</h4>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Event List</li>
                          </ol>
                      </nav>
                  </div>
              </div>
              
          </div>
      </div>
        
      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-12">
                    @include('backoffice._components.session_notif')
                  <div class="box">
                      <div class="box-body">
                          <div class="row">
                            <div class="col-md-4">
                                <form action="" method="get">
                                <input type="text" name="search" value="{{Input::has('search')?Input::get('search'):''}}" class="form-control pull-right" placeholder="Search for an Event...">
                                </form>
                            </div>
                            @if(auth()->user()->type != 'participant')
                            <div class="col-md-4 offset-md-4">
                                <a href="{{route('backoffice.events.create')}}" class="waves-effect waves-light btn btn-outline btn-primary mb-5 pull-right">Create New</a>
                            </div>
                            @endif
                          </div>
                          <div class="table-responsive rounded card-table overflow-visible">
                              <table class="table border-no" id="example1">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Title</th>
                                          <th>Schedule</th>
                                          <th>Status</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @forelse($events as $index => $event)
                                      <tr class="hover-primary">
                                          <td>{{$index+1}}</td>
                                          <td>{{$event->name}}</td>
                                          <td>
                                            <strong>Start</strong> : {{$event->start?date('M d, Y @ h:i a', strtotime($event->start)):'---'}} <br>
                                            <strong>End</strong> : {{$event->end?date('M d, Y @ h:i a', strtotime($event->end)):'---'}}
                                          </td>
                                          <td>{{$event->status}}</td>
                                          <td>												
                                              <div class="btn-group pull-right">
                                                @if(auth()->user()->type == 'participant')
                                                <!-- {{ auth()->user()->myCertificate($event->id) }} -->
                                                @if(auth()->user()->myCertificate($event->id))
                                                <a href="{{ route('backoffice.certificates.view', auth()->user()->myCertificate($event->id)->certificate_id) }}" target="_blank" class="waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; View Certificate</a>
                                                @endif
                                                <a href="{{ route('backoffice.events.view', $event->id) }}" class="waves-effect waves-light btn btn-primary-light"><i data-feather="message-square"></i>&nbsp; Give Feedback</a>
                                                @endif
                                                @if($event->status == 'Pending')
                                                <a href="{{ route('backoffice.events.update_status',[ $event->id, 'Happening']) }}" class="waves-effect waves-light btn btn-primary-light"><i data-feather="cast"></i>&nbsp; Mark as Happening</a>
                                                @elseif($event->status == 'Happening')
                                                <a href="{{ route('backoffice.events.update_status', [$event->id, 'Completed']) }}" class="waves-effect waves-light btn btn-success-light"><i data-feather="check"></i>&nbsp; Mark as Completed</a>
                                                @elseif($event->status == 'Completed' AND auth()->user()->type != 'participant')
                                                
                                                <!-- <a id="generateCertificateBtn_{{ $event->id }}" style="display: none;" href="{{ route('backoffice.events.generate_certificate', [$event->id, '']) }}" target="_blank" class=" waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; Generate Certificate</a> -->

                                                <!-- <a id="generateCertificateBtn_{{ $event->id }}" style="display: none;" href="{{ route('backoffice.events.certificate-prompt', [$event->id, '']) }}" target="_blank" class=" waves-effect waves-light btn btn-warning-light"><i data-feather="award"></i>&nbsp; Generate Certificate</a> -->

                                                <a id="" data-toggle="modal" data-target="#exampleModal" href="#" class="promptToggleBtn waves-effect waves-light btn btn-warning-light" data-event="{{ $event }}"><i data-feather="award"></i>&nbsp; Generate Certificate</a>
                                                
                                                @endif
                                                <a class="waves-effect waves-light btn btn-light no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('backoffice.events.view', $event->id) }}">View event</a>
                                                    @if(auth()->user()->type != 'participant')
                                                    <a class="dropdown-item" href="{{ route('backoffice.events.edit', $event->id) }}">Edit event</a>
                                                    <a class="dropdown-item" href="{{ route('backoffice.events.cancel', $event->id) }}">Cancel event</a>
                                                    @endif
                                                </div>
                                              </div>
                                          </td>
                                      </tr>
                                      @empty
                                      <tr class="hover-primary">
                                        <td colspan="7" class="text-center">No {{$title}} record yet...</td>
                                      </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>			
      </section>
      <!-- /.content -->
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
      <div class="modal-content">
        <form action="{{ route('backoffice.events.certificate-prompt') }}" method="POST" target="_blank">
        @csrf  <!-- This token is necessary for security reasons -->

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i data-feather="award"></i> Generate Certificate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <p>Enter the prompt that the AI will use to generate the certificate background.</p>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <input required readonly type="text" name="id" id="promptEventId" style="display:none;">
              <textarea required name="prompt" id="promptInput" style="width: 100%;" rows="5"></textarea>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-md-12">
              <label>Fonts Customization:</label>
              <br>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Heading</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-heading" name="cfheading">
                          <option disabled>Select Font</option>
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-heading-color" name="cfheadingcolor" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Title</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-title" name="cftitle">
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-title-color" name="cftitlecolor" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Text</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-text" name="cftext">
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-text-color" name="cftextcolor" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Quotes</label>
                    <div class="row">
                      <div class="col-lg-10">
                        <select class="form-control" id="cf-quotes" name="cfquotes">
                        </select>
                      </div>
                      <div class="col-lg-2">
                        <input type="color" class="form-control btn-sm" style="width:50px;height:30px:" id="cf-quotes-color" name="cfquotescolor" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-5">
            <div class="col-md-12">
              <label>Preview:</label>
              <br>
              <div class="row">

                <center>

                  <h1 id="preview-heading">CERTIFICATE OF COMPLETION</h1>
                  <label>IS PRESENTED TO:</label>
                  <br />
                  <h2 id="preview-title">Juan Dela Cruz</h2>
                  <br />

                  <div class="text-center" style="text-align:center;">
                    <label id="preview-text" >This is the texts section this is the texts section</label>
                    <br />
                    <label id="preview-quotes" style="font-style:italic;">" This is a sample quotation section "</label>
                  </div>

                </center>

              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>
      <div class="modal-footer float-right">
        <button id="useDefaultBtn" type="button" class="btn btn-secondary">Use Default</button>
        <button id="proceedBtn" type="submit" class="btn btn-primary">Proceed</button>
      </div>

    </form>
  </div>
    
  </div>
</div>

@endpush

@push('js')
<script src="{{asset('vet-clinic/main/js/vendors.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/chat-popup.js')}}"></script>
<script src="{{asset('vet-clinic/assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('vet-clinic/assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/template.js')}}"></script>
<script src="{{asset('vet-clinic/main/js/pages/events.js')}}"></script>

<script src="{{ URL::asset('custom/js/customfonts.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>


<script type="text/javascript">

  let currentEvent = {id: null, name: ''};

  const defaultPrompt = '{{ env('DEFAULT_PROMPT') }}';

  function setPromptInputValue () {
    $("#promptInput").val(defaultPrompt.replace("%event_name%", currentEvent.name));
    $("#promptEventId").val(currentEvent.id);
  }

  $(".promptToggleBtn").on("click", (e) => {
    let data = $(e.currentTarget).data("event");
    currentEvent = data;
    setPromptInputValue();
  });

  $("#useDefaultBtn").on("click", () => {
    setPromptInputValue();
  });


  // font customizations
  loadCustomFonts("cf-heading", "preview-heading")
  loadCustomFonts("cf-title", "preview-title")
  loadCustomFonts("cf-text", "preview-text")
  loadCustomFonts("cf-quotes", "preview-quotes")

  $("#cf-heading-color").on("change", (e) => {
    $("#preview-heading").css("color", e.currentTarget.value)
  })

  $("#cf-title-color").on("change", (e) => {
    $("#preview-title").css("color", e.currentTarget.value)
  })

  $("#cf-text-color").on("change", (e) => {
    $("#preview-text").css("color", e.currentTarget.value)
  })

  $("#cf-quotes-color").on("change", (e) => {
    $("#preview-quotes").css("color", e.currentTarget.value)
  })

</script>

@endpush
