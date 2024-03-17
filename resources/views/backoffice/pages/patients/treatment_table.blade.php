<div class="col-md-8">
    <table class="table table-responsive table-justified">
        <tr>
            <td style="width: 5%">Date</td>
            <td style="width: 20%">Procedure</td>
            <td style="width: 20%">Next Procedure</td>
            <td style="width: 15%">Payment</td>
            <td style="width: 15%">Balance</td>
            <td style="width: 15%">Doctor</td>
        </tr>
        @if($treatments->count() > 0)
        @foreach($treatments as $index => $treatmentItem)
        <tr>
            <td><input type="date" name="date[]" class="form-control input-sm" value="{{$treatmentItem->date?$treatmentItem->date:old('date[]')}}" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td>
                <select name="service_id[]" class="form-control bg-white input-sm" {{ auth()->user()->type == 'patient'?'disabled':'' }}>
                    <option value="">---</option>
                    @foreach($services as $index => $service)
                    @if($treatmentItem->service_id == $service->id)
                    <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                    @endif
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="next_procedure[]" value="{{$treatmentItem->next_procedure?$treatmentItem->next_procedure:old('next_procedure[]')}}" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td><input type="number" name="payment[]" step="any" value="{{$treatmentItem->payment?$treatmentItem->payment:old('payment[]')}}" min="0" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td><input type="number" name="balance[]" step="any" value="{{$treatmentItem->balance?$treatmentItem->balance:old('balance[]')}}" min="0" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td><input type="text" name="doctor[]" value="{{$treatmentItem->doctor?$treatmentItem->doctor:old('doctor[]')}}" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
        </tr>
        @endforeach
        @else
        @foreach(range(1,10) as $index)
        <tr>
            <td><input type="date" name="date[]" value="{{old('date[]')}}" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td>
                <select name="service_id[]" class="form-control bg-white input-sm" {{ auth()->user()->type == 'patient'?'disabled':'' }}>
                    <option value="">---</option>
                    @foreach($services as $index => $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="text" name="next_procedure[]" value="{{old('next_procedure[]')}}" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td><input type="number" name="payment[]" value="{{old('payment[]')}}" step="any" min="0" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td><input type="number" name="balance[]" value="{{old('balance[]')}}" step="any" min="0" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
            <td><input type="text" name="doctor[]" value="{{old('doctor[]')}}" class="form-control input-sm" {{auth()->user()->type == 'patient'?'readonly':''}}></td>
        </tr>
        @endforeach
        @endif
    </table>
</div>