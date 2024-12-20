@extends('backoffice._layout.main')

@push('title','Appointment Request')

@push('css')
<style>
    .start-date-error{
        display: none;
    }
    .end-date-error{
        display: none;
    }
    .input-select{
        background-color: white!important;
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
                                <li class="breadcrumb-item active" aria-current="page">Event Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-5">
                    @include('backoffice._components.session_notif')
                    <div class="box">
                        <div class="box-header with-border">
                            <strong class="">{{ $event->status }}</strong><br>
                            <h1 class="box-title text-primary">{{ $event->name }}</h1><br>
                            <span><i class="mdi mdi-calendar-clock"></i> {{$event->start?date('M d, Y @ h:i a', strtotime($event->start)):'---'}}</span> - 
                            <span>{{$event->end?date('M d, Y @ h:i a', strtotime($event->end)):'---'}}</span>
                        </div>
                        <div class="box-body">
                            {!! $event->details !!}
                        </div>
                    </div>
                    @if(auth()->check() AND auth()->user()->type == 'participant' AND $event->status == 'Happening' AND !$attendance)
                    <a href="{{route('backoffice.events.index')}}" class="btn waves-effect waves-light btn btn-warning me-1">
                        Cancel
                    </a>
                    <a href="{{route('backoffice.events.attend', $event->id)}}" class="btn waves-effect waves-light btn btn-primary ">
                        Attend
                    </a>
                    @endif
                </div>
                <div class="col-md-7">
                    
					<!-- <div class="box">
						<div class="box-header with-border">
							<h4 class="box-title"><i data-feather="message-square"></i> Feedbacks</h4>
						</div>
						<div class="box-body p-0">
							<div class="inner-user-div">
                                @forelse($feedbacks as $feedback)
                                <div class="media-list bb-1 bb-dashed border-light">
                                    <div class="media align-items-center">
                                        <a class="avatar avatar-lg status-success" href="#">
                                            <img src="{{ asset($feedback->user->getAvatar()) }}" class="bg-success-light" alt="...">
                                        </a>
                                        <div class="media-body">
                                            <p class="fs-16">
                                                <a class="hover-primary" href="{{ route('backoffice.participants.view', $feedback->user->participant->id) }}">{{ $feedback->user->name }}</a>
                                            </p>
                                            <span class="text-muted">{{ $feedback->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="media-right">
                                        </div>
                                    </div>					
                                    <div class="media pt-0">
                                        <p class="text-fade">{{$feedback->comment}}</p>
                                    </div>
                                </div>
                                @empty
                                <div class="media-list bb-1 bb-dashed border-light">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <h4 class="text-center">No feedbacks yet...</h4>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
							</div>
						</div>

                       

						<div class="box-footer">
                            @if(auth()->user()->type != 'participant')
							<a href="{{ route('backoffice.feedbacks.index', ['event_id' => $event->id]) }}" class="d-block w-p100 waves-effect waves-light btn btn-primary-light">See More Feedbacks</a>
                            @else
                            @if($attendance)
                            <form action="{{ route('backoffice.feedbacks.add') }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group {{$errors->has('comment')?'error':null}}">
                                            <div class="input-group">
                                                <input type="text" name="comment" class="form-control ps-15 bg-transparent form-control-md" placeholder="Add a comment..." required>
                                            </div>
                                            @if($errors->has('comment'))
                                            <span class="help-block"><ul role="alert"><li>{{$errors->first('comment')}}</li></ul></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" class="waves-effect waves-light btn btn-primary-light btn-circle btn-sm"><i data-feather="send"></i></button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            @endif
						</div>
					</div> -->

                    @if($event->status == 'Completed')

                    <div class="box">
						<div class="box-header with-border">
							<h4 class="box-title"><i data-feather="message-square"></i> Feedbacks</h4>
						</div>
						<div class="box-body p-0">
							<div class="inner-user-div">
                                <form action="{{ route('backoffice.feedbacks.add') }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                @foreach($feedback_questions_with_answer as $feedback)
                                    <div class="media-list bb-1 bb-dashed border-light">
                                        <div class="media pt-2">
                                            <p class="text-"><?php echo str_replace("QUE", "?", $feedback->question); ?></p>
                                        </div>
                                        @if(isset($feedback->user_answer) && $feedback->user_answer != '')
                                            <div class="media align-items-center">                                        
                                                <div class="media-body">
                                                    <p class="text-primary">{{$feedback->user_answer}}</p>
                                                </div>
                                                <div class="media-rightx">                                            
                                                    <span class="text-muted">{{ $feedback->user_answer_date != '' ? $feedback->user_answer_date->diffForHumans() : '' }}</span>
                                                </div>
                                            </div>
                                        @else
                                            @if(auth()->user()->type != 'participant')
							                    <a href="{{ route('backoffice.feedbacks.index', ['event_id' => $event->id]) }}" class="d-block w-p100 waves-effect waves-light btn btn-primary-light">See More Feedbacks</a>
                                            @else
                                            @if($attendance)
                                                
                                                    
                                                    <input type="hidden" name="feedback_question_id[]" value="{{ $feedback->id }}">
                                                    <input type="hidden" name="feedback_question[]" value="{{ $feedback->question }}">

                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="form-group {{$errors->has('comment')?'error':null}}">
                                                                <div class="input-group">
                                                                    @if($feedback->type == 'fill')
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comment[]" class="form-control ps-15 bg-transparent form-control-md" placeholder="Your answer..." required>
                                                                    @elseif($feedback->type == 'rating')
                                                                    <div>           
                                                                        <input type="hidden" name="comment[]" id="ratingradioid{{ $feedback->id }}" />                                                             
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="ratingradioid{{ $feedback->id }}" type="radio" id="ratingradio1id{{ $feedback->id }}" value="1" required data-for="ratingradioid{{ $feedback->id }}">
                                                                            <label class="form-check-label" for="ratingradio1id{{ $feedback->id }}">1</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="ratingradioid{{ $feedback->id }}" type="radio" id="ratingradio2id{{ $feedback->id }}" value="2" required data-for="ratingradioid{{ $feedback->id }}">
                                                                            <label class="form-check-label" for="ratingradio2id{{ $feedback->id }}">2</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="ratingradioid{{ $feedback->id }}" type="radio" id="ratingradio3id{{ $feedback->id }}" value="3" required data-for="ratingradioid{{ $feedback->id }}">
                                                                            <label class="form-check-label" for="ratingradio3id{{ $feedback->id }}">3</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="ratingradioid{{ $feedback->id }}" type="radio" id="ratingradio4id{{ $feedback->id }}" value="4" required data-for="ratingradioid{{ $feedback->id }}">
                                                                            <label class="form-check-label" for="ratingradio4id{{ $feedback->id }}">4</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" name="ratingradioid{{ $feedback->id }}" type="radio" id="ratingradio5id{{ $feedback->id }}" value="5" required data-for="ratingradioid{{ $feedback->id }}">
                                                                            <label class="form-check-label" for="ratingradio5id{{ $feedback->id }}">5</label>
                                                                        </div>
                                                                        <p class="text-light"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Strongly Disagree <span style="float:right;">Strongly Agree</span></p>
                                                                    </div>
                                                                    @elseif($feedback->type == 'select')
                                                                    <div>
                                                                        <?php 
                                                                            $choices = explode('andseparator', $feedback->choices);
                                                                            foreach ($choices as $key => $choice) {
                                                                                echo '<div class="form-check">
                                                                                    <input class="form-check-input" name="comment[]" type="radio" id="selectradio'.$key.'id'.$feedback->id.'" value="'.$choice.'" required>
                                                                                    <label class="form-check-label" for="selectradio'.$key.'id'.$feedback->id.'">'.$choice.'</label>
                                                                                </div>';
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                @if($errors->has('comment'))
                                                                <span class="help-block"><ul role="alert"><li>{{$errors->first('comment')}}</li></ul></span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                                <div class="row col-md-12 m-5 p-5 d-flex">
                                    <div class="col-lg-8"></div>
                                    <div class="col-lg-3 btn btn-info float-right">
                                        <span>Submit</span> <button type="submit" class="waves-effect waves-light btn btn-primary-light btn-circle btn-sm"><i data-feather="send"></i></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endif


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
    $(".form-check-input").on("click", (e) => {
        let value = $(e.currentTarget).val()
        let commentInputId = $(e.currentTarget).data("for")
        $(`#${commentInputId}`).val(value)
    })
</script>

@endpush