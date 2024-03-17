<div class="col-md-4">
    <div class="mt-3">
        Name: <strong>{{$treatment->patient->user->name}}</strong>
    </div>
    <div class="mt-3">
        @php
            $dob = new DateTime($treatment->patient->birthdate);

            // Get current date
            $now = new DateTime();
            
            // Calculate the time difference between the two dates
            $diff = $now->diff($dob);
        @endphp

        Age: <strong>{{$diff->y}} years old</strong>

    </div>
    <div class="mt-3">
        Birthday: <strong>{{date('M d, Y',strtotime($treatment->patient->birthdate))}}</strong>
    </div>
    <div class="mt-3">
        Gender: <strong>{{Str::title($treatment->patient->gender)}}</strong>
    </div>
    <div class="mt-3">
        Address: <strong>{{$treatment->patient->address}}</strong>
    </div>
    <div class="mt-3">
        Mobile Number: <strong>{{$treatment->patient->user->contact_number}}</strong>
    </div>
    <div class="mt-3">
        School/Office: <input type="text" class="form-control" value="{{$treatment->school_office?$treatment->school_office:old('school_office')}}" name="school_office" {{auth()->user()->type == 'patient'? 'readonly':'' }}>
    </div>
    <div class="mt-3">
        Diagnosis: <input type="text" class="form-control" value="{{$treatment->diagnosis?$treatment->diagnosis:old('diagnosis')}}" name="diagnosis" {{auth()->user()->type == 'patient'? 'readonly':'' }}>
    </div>
    <div class="mt-3">
        Treatment Plan Summary: 
        <textarea name="plan_summary" class="form-control" id="" cols="30" rows="5" {{auth()->user()->type == 'patient'? 'readonly':'' }}>{{$treatment->plan_summary}}</textarea>
    </div>
    <div class="mt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="checkbox">
                    <input type="checkbox" id="basic_checkbox_1" name="panoramic" value="1" {{$treatment->panoramic?'checked':''}} {{auth()->user()->type == 'patient'? 'readonly':'' }}>
                    <label for="basic_checkbox_1">PANORAMIC</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="checkbox">
                    <input type="checkbox" id="basic_checkbox_2" name="photo" value="1" {{$treatment->photo?'checked':''}} {{auth()->user()->type == 'patient'? 'readonly':'' }}>
                    <label for="basic_checkbox_2">PHOTO</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="checkbox">
                    <input type="checkbox" id="basic_checkbox_3" name="ceph" value="1" {{$treatment->ceph?'checked':''}} {{auth()->user()->type == 'patient'? 'readonly':'' }}>
                    <label for="basic_checkbox_3">CEPH</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="checkbox">
                    <input type="checkbox" id="basic_checkbox_4" name="cast" value="1" {{$treatment->cast?'checked':''}} {{auth()->user()->type == 'patient'? 'readonly':'' }}>
                    <label for="basic_checkbox_4">CAST</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="checkbox">
                    <input type="checkbox" id="basic_checkbox_5" name="tmj" value="1" {{$treatment->tmj?'checked':''}} {{auth()->user()->type == 'patient'? 'readonly':'' }}>
                    <label for="basic_checkbox_5">TMJ</label>
                </div>
            </div>
        </div>
    </div>
</div>