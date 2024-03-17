<div class="row">
    <div class="col-md-6">
        @include('backoffice._components.session_notif')
        <form class="form" action="" method="POST">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Service Information</h4>
            </div>
            <!-- /.box-header -->
                {{csrf_field()}}
                @if($service)
                <input type="hidden" name="id" value="{{ $service->id }}" class="form-control">
                @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->has('name')?'error':null}}">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{old('name',$service?$service->name:'')}}" class="form-control" placeholder="Name">
                                @if($errors->has('name'))
                                <div class="help-block"><ul role="alert"><li>{{$errors->first('name')}}</li></ul></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->has('type')?'error':null}}">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select name="type" class="form-control bg-white" id="">
                                    <option value="">---</option>
                                    @foreach($types as $index => $type)
                                    @if($service AND $service->type == $index)
                                    <option value="{{ $index }}" selected>{{ $type }}</option>
                                    @else
                                    <option value="{{ $index }}">{{ $type }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if($errors->has('type'))
                                <div class="help-block"><ul role="alert"><li>{{$errors->first('type')}}</li></ul></div>
                                @endif
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group {{$errors->has('price')?'error':null}}">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" value="{{old('price',$service?$service->price:'')}}" class="form-control" placeholder="Price">
                                @if($errors->has('price'))
                                <div class="help-block"><ul role="alert"><li>{{$errors->first('price')}}</li></ul></div>
                                @endif
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row">
                        <div class="form-group {{$errors->has('description')?'error':null}}">
                            <label class="form-label">Description</label>
                            <textarea rows="3" name="description" class="form-control" placeholder="Description">{{old('description',$service?$service->description:'')}}</textarea>
                            @if($errors->has('description'))
                            <div class="help-block"><ul role="alert"><li>{{$errors->first('description')}}</li></ul></div>
                            @endif
                        </div>
                    </div> -->
                </div>
                <!-- /.box-body -->
        </div>
        
        <a href="{{route('backoffice.services.index')}}" class="btn waves-effect waves-light btn btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
            </form>
    </div>
    
    @if($service)
    <div class="col-md-6">
        <div class="box no-border no-shadow">
            <div class="box-header with-border">
                <h4 class="box-title">Types</h4>
            </div>
            <div class="box-body overflow-auto">
                <!-- the events -->
                <div id="external-events">
                    <table class="table border-no" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($serviceTypes as $index => $type)
                            <tr class="hover-primary">
                                <td>{{$index+1}}</td>
                                <td>{{$type->type}}</td>
                                <td>{{number_format($type->price, 2)}}</td>
                                <td>{{$type->description}}</td>
                                <td>												
                                    <div class="btn-group">
                                        <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('backoffice.services.editType', $type->id) }}">Edit</a>
                                            <a class="dropdown-item" href="{{ route('backoffice.services.deleteType', $type->id) }}">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="hover-primary">
                                <td colspan="5" class="text-center">No service types yet...</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{route('backoffice.services.addType',$service->id)}}" class="btn waves-effect waves-light btn btn-primary">
            <i class="ti-plus"></i> Add Service Type
        </a>
    </div>
    @endif
</div>