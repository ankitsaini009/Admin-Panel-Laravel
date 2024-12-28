@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Create Coupon</h2><br>
                <form action="{{ route('coupons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="coupons_id" value="{{(isset($Coupondata)?$Coupondata->id:'')}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" name="Code" placeholder="Enter Coopon Code" value="{{(isset($Coupondata)?$Coupondata->code:old('Code'))}}" autocomplete="off">
                            @if ($errors->has('Code'))
                            <div class="text-danger">{{ $errors->first('Code') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Discount" class="form-label">Discount</label>
                            <input type="number" class="form-control" name="Discount" placeholder="Enter Discount" value="{{(isset($Coupondata)?$Coupondata->discount:old('Discount'))}}" autocomplete="off">
                            @if ($errors->has('Discount'))
                            <div class="text-danger">{{ $errors->first('Discount') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Expire_date" class="form-label">Expires At</label>
                            <input type="date" class="form-control" name="Expire_date" value="{{(isset($Coupondata)?$Coupondata->expire_date:old('phone'))}}" autocomplete="off">
                            @if ($errors->has('Expire_date'))
                            <div class="text-danger">{{ $errors->first('Expire_date') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Discount_Type" class="form-label">Discount Type</label>
                            <select name="Discount_Type" class="form-control">
                                <option value="Percent" {{ (isset($Coupondata) && $Coupondata->discount_type == 'Percent') ? 'selected' : (old('Percent') == 'Percent' ? 'selected' : '') }}>Percent</option>
                                <option value="Percent" {{ (isset($Coupondata) && $Coupondata->discount_type == 'Fixed') ? 'selected' : (old('Fixed') == 'Fixed' ? 'selected' : '') }}>Fixed</option>
                            </select>
                            @if ($errors->has('Discount_Type'))
                            <div class="text-danger">{{ $errors->first('Discount_Type') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="Description" class="form-label">Description</label>
                            <textarea name="Description" placeholder="Enter Description " class="form-control" id="Description">{{ isset( $Coupondata->description )?$Coupondata->description :old('Description')}}</textarea>
                            @if ($errors->has('Description'))
                            <div class="text-danger">{{ $errors->first('Description') }}</div>
                            @endif
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Enabled" value="1"
                                    {{ (isset($Coupondata) && $Coupondata->enabled == 1) ? 'checked' : '' }} id="Enabled">
                                <label class="form-check-label" for="Enabled">Enabled</label>
                            </div>
                            @if ($errors->has('Enabled'))
                            <div class="text-danger">{{ $errors->first('Enabled') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{(isset($Coupondata)? "Update Coupon" : "Create Coupon")}}</button>
                        <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Back to Coupons</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection