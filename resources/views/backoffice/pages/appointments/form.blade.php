<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($appointment)
    <input type="hidden" name="id" value="{{ $appointment->id }}" class="form-control">
    <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}" class="form-control">
    <input type="hidden" name="service_id" value="{{ $appointment->service_id }}" class="form-control">
    <input type="hidden" name="service_type" value="{{ $appointment->service_type_id }}" class="form-control">
    <input type="hidden" name="details" value="{{ $appointment->details }}" class="form-control">
    @else
    <input type="hidden" name="patient_id" value="{{ auth()->user()->patient->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('service_id')?'error':null}}">
                    <label class="form-label">Service <span class="text-danger">*</span></label>
                    <select name="service_id" class="form-control bg-white {{ auth()->user()->type != 'patient'?'bg-secondary':'' }} input-service" {{ auth()->user()->type != 'patient'?'disabled':'' }}>
                        <option value="">---</option>
                        @foreach($services as $index => $service)
                        @if($appointment AND $appointment->service_id == $index OR old('service_id') == $index)
                        <option value="{{ $index }}" selected>{{ $service }}</option>
                        @else
                        <option value="{{ $index }}">{{ $service }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('service_id'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('service_id')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('service_type')?'error':null}}">
                    <label class="form-label">Service Type <span class="text-danger">*</span></label>
                    <select name="service_type" class="form-control bg-white {{ auth()->user()->type != 'patient'?'bg-secondary':'' }} input-service-type" {{ auth()->user()->type != 'patient'?'disabled':'' }}>
                        @if($appointment AND $appointment->serviceType)
                        <option value="{{ $appointment->serviceType->id }}">{{ $appointment->serviceType->type }}</option>
                        @else
                        <option value="">---</option>
                        @endif
                    </select>
                    @if($errors->has('service_type'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('service_type')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('service_type')?'error':null}}">
                    @if($appointment AND $appointment->serviceType)
                    <label class="form-label">Price : ₱ <span class="text-price">{{ number_format($appointment->serviceType->price, 2) }}</span></label>
                    @else
                    <label class="form-label">Price : ₱ <span class="text-price">0.00</span></label>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('service_type')?'error':null}}">
                    @if($appointment AND $appointment->serviceType)
                    <label class="form-label">Description : <span class="text-description">{{ $appointment->serviceType->description }}</span></label>
                    @else
                    <label class="form-label">Description : <span class="text-description">---</span></label>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('details')?'error':null}}">
                <label class="form-label">Details </label>
                <textarea rows="3" name="details" class="form-control {{ auth()->user()->type != 'patient'?'bg-secondary':'' }}" {{ auth()->user()->type != 'patient'?'readonly':'' }} placeholder="Additional details or notes.">{{old('details',$appointment?$appointment->details:'')}}</textarea>
                @if($errors->has('details'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('details')}}</li></ul></div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('start_date')?'error':null}} start-date">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" min="{{date('Y-m-d')}}" id="start" value="{{old('start_date',$appointment?date('Y-m-d', strtotime($appointment->start)):'')}}" class="form-control {{ auth()->user()->type != 'patient'?'bg-secondary':'' }}" placeholder="Date" {{ auth()->user()->type != 'patient'?'readonly':'' }}>
                    @if($errors->has('start_date'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('start_date')}}</li></ul></div>
                    @endif
                    <div class="help-block start-date-error"><ul role="alert"><li>Please select a time between 8am and 5pm.</li></ul></div>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group {{$errors->has('end_date')?'error':null}} end-date">
                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                    <input type="date" name="end_date" min="{{date('Y-m-d')}}" id="end" value="{{old('end_date',$appointment?date('Y-m-d',strtotime($appointment->end)):'')}}" class="form-control {{ auth()->user()->type != 'patient'?'bg-secondary':'' }}" placeholder="End Date" {{ auth()->user()->type != 'patient'?'readonly':'' }}>
                    @if($errors->has('end_date'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('end_date')}}</li></ul></div>
                    @endif
                    <div class="help-block end-date-error"><ul role="alert"><li>Please select a time between 8am and 5pm.</li></ul></div>
                </div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('start_time')?'error':null}} start-date">
                    <label class="form-label">Start Time <span class="text-danger">*</span></label>
                    <select name="start_time" id="start-time" class="form-control {{ auth()->user()->type != 'patient'?'bg-secondary':'input-select' }}" {{ auth()->user()->type != 'patient'?'disabled':'' }}>
                        <!-- {!!date('H') > 8 ? 'disabled' : ''!!} -->
                        @foreach($time as $index => $hour)
                        @if($appointment AND date('H', strtotime($appointment->start)) == $index OR old('start_time') == $index)
                        <option value="{{ $index }}" selected>{{ $hour }}</option>
                        @else
                        <option value="{{ $index }}">{{ $hour }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('start_time'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('start_time')}}</li></ul></div>
                    @endif
                    <div class="help-block start-date-error"><ul role="alert"><li>Please select a time between 8am and 5pm.</li></ul></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('end_time')?'error':null}} end-date">
                    <label class="form-label">End Time <span class="text-danger">*</span></label>
                    <select name="end_time" id="end-time" class="form-control {{ auth()->user()->type != 'patient'?'bg-secondary':'input-select' }}" {{ auth()->user()->type != 'patient'?'disabled':'' }}>
                        @foreach($time as $index => $hour)
                        @if($appointment AND date('H', strtotime($appointment->end)) == $index OR old('end_time') == $index)
                        <option value="{{ $index }}" selected>{{ $hour }}</option>
                        @else
                        <option value="{{ $index }}">{{ $hour }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('end_time'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('end_time')}}</li></ul></div>
                    @endif
                    <div class="help-block end-date-error"><ul role="alert"><li>Please select a time between 8am and 5pm.</li></ul></div>
                </div>
            </div>
        </div>
        @if(auth()->user()->type != 'patient')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('status')?'error':null}}">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control bg-white input-pet">
                        <option value="">---</option>
                        @foreach($statuses as $index => $status)
                        @if($appointment AND $appointment->status == $status OR old('status') == $index)
                        <option value="{{ $status }}" selected>{{ $status }}</option>
                        @else
                        <option value="{{ $status }}">{{ $status }}</option>
                        @endif
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('status')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.appointments.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="fa fa-sign-out" style="font-size:24px"></i> Exit
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>