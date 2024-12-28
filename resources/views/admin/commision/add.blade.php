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
                <h2>Admin Commision</h2><br><br>
                <form action="{{ route('commission.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="commission_id" value="{{ isset($Admin_commision) ? $Admin_commision->id : '' }}">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="enable" name="enable"
                                    value="1" {{ isset($Admin_commision) && $Admin_commision->Enable == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable">Enable Admin Commission</label>
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="admin_commission" class="form-label">Admin Commission</label>
                            <input type="number" class="form-control" id="admin_commission" name="admin_commission"
                                placeholder="Enter Admin Commission"
                                value="{{ isset($Admin_commision) ? $Admin_commision->admin_commission : old('admin_commission') }}" autocomplete="off">
                            @if ($errors->has('admin_commission'))
                            <div class="text-danger">{{ $errors->first('admin_commission') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="commission_type" class="form-label">Commission Type</label>
                            <select name="commission_type" id="commission_type" class="form-control">
                                <option value="Fixed" {{ isset($Admin_commision) && $Admin_commision->commission_type == 'Fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="Percentage" {{ isset($Admin_commision) && $Admin_commision->commission_type == 'Percentage' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            @if ($errors->has('commission_type'))
                            <div class="text-danger">{{ $errors->first('commission_type') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('commission.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection