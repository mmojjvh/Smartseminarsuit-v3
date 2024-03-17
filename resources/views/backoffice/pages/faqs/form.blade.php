<form class="form" action="" method="POST">
    {{csrf_field()}}
    @if($faq)
    <input type="hidden" name="id" value="{{ $faq->id }}" class="form-control">
    @endif
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('sequence')?'error':null}}">
                    <label class="form-label">Sequence <span class="text-danger">*</span></label>
                    <input type="number" name="sequence" value="{{old('sequence',$faq?$faq->sequence:'')}}" class="form-control" placeholder="Sequence">
                    @if($errors->has('sequence'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('sequence')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('question')?'error':null}}">
                    <label class="form-label">Question <span class="text-danger">*</span></label>
                    <input type="text" name="question" value="{{old('question',$faq?$faq->question:'')}}" class="form-control" placeholder="Question">
                    @if($errors->has('question'))
                    <div class="help-block"><ul role="alert"><li>{{$errors->first('question')}}</li></ul></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{$errors->has('answer')?'error':null}}">
                <label class="form-label">Answer</label>
                <textarea rows="3" name="answer" class="form-control" placeholder="Answer">{{old('answer',$faq?$faq->answer:'')}}</textarea>
                @if($errors->has('answer'))
                <div class="help-block"><ul role="alert"><li>{{$errors->first('answer')}}</li></ul></div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-end">
        <a href="{{route('backoffice.faqs.index')}}" class="btn waves-effect waves-light btn btn-outline btn-warning me-1">
            <i class="ti-trash"></i> Cancel
        </a>
        <button type="submit" class="btn waves-effect waves-light btn btn-outline btn-primary ">
            <i class="ti-save-alt"></i> Save
        </button>
    </div>  
</form>