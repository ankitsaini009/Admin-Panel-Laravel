@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h2>Tax Setting</h2><br><br>
                <form action="{{ route('tax.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tax_id" value="{{ isset($Tax_setting) ? $Tax_setting->id : '' }}">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="enable" name="enable"
                                    value="1" {{ isset($Tax_setting) && $Tax_setting->Enable == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable">Is Enable</label>
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="tax" class="form-label">Tax</label>
                            <input type="number" class="form-control" id="tax" name="tax"
                                placeholder="Enter Tax"
                                value="{{ isset($Tax_setting) ? $Tax_setting->Tax : old('tax') }}" autocomplete="off">
                            @if ($errors->has('tax'))
                            <div class="text-danger">{{ $errors->first('tax') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Label" class="form-label">Label</label>
                            <input type="text" class="form-control" id="Label" name="Label"
                                placeholder="Enter Label"
                                value="{{ isset($Tax_setting) ? $Tax_setting->Label : old('Label') }}" autocomplete="off">
                            @if ($errors->has('Label'))
                            <div class="text-danger">{{ $errors->first('Label') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="commission_type" class="form-label">Type</label>
                            <select name="Type" id="Type" class="form-control">
                                <option value="Fixed" {{ isset($Tax_setting) && $Tax_setting->Type == 'Fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="Percentage" {{ isset($Tax_setting) && $Tax_setting->Type == 'Percentage' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            @if ($errors->has('commission_type'))
                            <div class="text-danger">{{ $errors->first('commission_type') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('tax.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection