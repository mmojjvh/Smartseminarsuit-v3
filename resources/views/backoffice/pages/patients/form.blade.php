<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($patient)
    <input type="hidden" name="user_id" value="{{ $patient->user->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{$errors->has('fname')?'error':null}}">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="fname" value="{{old('fname',$patient?$patient->fname:'')}}" class="form-control" placeholder="First Name">
                    @if($errors->has('fname'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('fname')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('mname')?'error':null}}">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="mname" value="{{old('mname',$patient?$patient->mname:'')}}" class="form-control" placeholder="Last Name">
                    @if($errors->has('mname'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('mname')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('lname')?'error':null}}">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="lname" value="{{old('lname',$patient?$patient->lname:'')}}" class="form-control" placeholder="Last Name">
                    @if($errors->has('lname'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('lname')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('gender')?'error':null}}">
                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-control" id="" required>
                        <option value="">-- Gender ---</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    @if($errors->has('gender'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('gender')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('birthdate')?'error':null}}">
                    <label class="form-label">Birthdate <span class="text-danger">*</span></label>
                    <input type="date" name="birthdate" value="{{ old('birthdate') }}" class="form-control" placeholder="Date of Birth" required>
                    @if($errors->has('birthdate'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('birthdate')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('username')?'error':null}}">
                    <label class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" value="{{old('username',$patient?$patient->username:'')}}" class="form-control" placeholder="Username">
                    @if($errors->has('username'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('username')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('email')?'error':null}}">
                    <label class="form-label">E-mail <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{old('email',$patient?$patient->user->email:'')}}" class="form-control" placeholder="E-mail">
                    @if($errors->has('email'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('email')}}</li></ul></div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('contact_number')?'error':null}}">
                    <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                    <input type="text" name="contact_number" value="{{old('contact_number',$patient?$patient->user->contact_number:'')}}" class="form-control" placeholder="Contact Number" data-inputmask="'mask':[ '(9999)999-9999']" data-mask>
                    @if($errors->has('contact_number'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('contact_number')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('address')?'error':null}}">
                <label class="form-label">Address <span class="text-danger">*</span></label>
                <textarea rows="3" name="address" class="form-control" placeholder="Address">{{old('address',$patient?$patient->address:'')}}</textarea>
                @if($errors->has('address'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('address')}}</li></ul></div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.patients.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>