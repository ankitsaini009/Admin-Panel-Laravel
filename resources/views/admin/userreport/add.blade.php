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
                <h2>User Reports</h2><br><br>
                <form action="{{ route('userreport.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Select Status</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (isset($userdata) && $userdata->status == 'active') ? 'selected' : (old('status') == 'active' ? 'selected' : '') }}>Active</option>
                                <option value="inactive" {{ (isset($userdata) && $userdata->status == 'inactive') ? 'selected' : (old('status') == 'inactive' ? 'selected' : '') }}>Inactive</option>
                            </select>
                            @if ($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="commission_type" class="form-label">Date</label>
                            <select name="Date" id="Date" class="form-control">
                                <option value="">Select Date</option>
                                <option value="Today">Today</option>
                                <option value="This_Week">This Week</option>
                                <option value="This_Month">This Month</option>
                                <option value="This_Year">This Year</option>
                            </select>
                            @if ($errors->has('Date'))
                            <div class="text-danger">{{ $errors->first('Date') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">From</label>
                            <input type="date" class="form-control" name="From" placeholder="Enter From" autocomplete="off">
                            @if ($errors->has('From'))
                            <div class="text-danger">{{ $errors->first('From') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">To</label>
                            <input type="date" class="form-control" name="To" placeholder="Enter To" autocomplete="off">
                            @if ($errors->has('To'))
                            <div class="text-danger">{{ $errors->first('To') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="commission_type" class="form-label">Select File Format</label>
                            <select name="Date" id="Date" class="form-control">
                                <option value="">Select File Format</option>
                                <option value="xls">xls</option>
                                <option value="csv">csv</option>
                                <option value="pdf">pdf</option>
                            </select>
                            @if ($errors->has('Date'))
                            <div class="text-danger">{{ $errors->first('Date') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('userreport.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection