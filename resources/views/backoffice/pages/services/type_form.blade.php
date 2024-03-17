<div class="row">
    <div class="col-md-6">
        @include('backoffice._components.session_notif')
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Service Information</h4>
            </div>
            <!-- /.box-header -->
            <form class="form" action="" method="POST">
                {{csrf_field()}}
                @if($service)
                <input type="hidden" name="service_id" value="{{ $service->id }}" class="form-control">
                @endif
                
                @if($serviceType)
                <input type="hidden" name="type_id" value="{{ $serviceType->id }}" class="form-control">
                @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->has('type')?'error':null}}">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <input type="text" name="type" value="{{old('type',$serviceType?$serviceType->type:'')}}" class="form-control" placeholder="Type">
                                @if($errors->has('type'))
                                <div class="help-block"><ul role="alert"><li>{{$errors->first('type')}}</li></ul></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->has('price')?'error':null}}">
                                <label class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="number" name="price" value="{{old('price',$serviceType?$serviceType->price:'')}}" class="form-control" placeholder="Price">
                                @if($errors->has('price'))
                                <div class="help-block"><ul role="alert"><li>{{$errors->first('price')}}</li></ul></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group {{$errors->has('description')?'error':null}}">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea rows="3" name="description" class="form-control" placeholder="Description">{{old('description',$serviceType?$serviceType->description:'')}}</textarea>
                            @if($errors->has('description'))
                            <div class="help-block"><ul role="alert"><li>{{$errors->first('description')}}</li></ul></div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-end">
                    <a href="{{route('backoffice.services.edit', $service->id)}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
                        <i class="ti-trash"></i> Cancel
                    </a>
                    <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
                        <i class="ti-save-alt"></i> Save
                    </button>
                </div>  
            </form>
        </div>
    </div>
</div>