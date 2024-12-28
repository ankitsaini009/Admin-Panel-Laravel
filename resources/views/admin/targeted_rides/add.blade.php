@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Targeted Rides</h2><br>
                <form action="{{ route('targeted.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="targeted_id" value="{{(isset($Targeted_ride)?$Targeted_ride->id:'')}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Start_Date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="Start_Date" value="{{(isset($Targeted_ride)?$Targeted_ride->Start_Date:old('Start_Date'))}}" autocomplete="off">
                            @if ($errors->has('Start_Date'))
                            <div class="text-danger">{{ $errors->first('Start_Date') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="End_Date" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="End_Date" value="{{(isset($Targeted_ride)?$Targeted_ride->End_Date:old('End_Date'))}}" autocomplete="off">
                            @if ($errors->has('End_Date'))
                            <div class="text-danger">{{ $errors->first('End_Date') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3 text-center">
                            <button type="button" id="add-new-btn" class="btn btn-success">Add New</button>
                        </div>
                        @if(isset($Targeted_rides_daily) && count($Targeted_rides_daily) > 0)
                        <div id="dynamic-fields">
                            @foreach($Targeted_rides_daily as $key => $rides)
                            <div class="row mb-3 dynamic-field">
                                <div class="col-md-5">
                                    <label for="Daily_Rides" class="form-label">Daily Rides</label>
                                    <input type="number" class="form-control" name="Daily_Rides[]"
                                        value="{{ old('Daily_Rides.'.$key, $rides->Daily_Rides) }}"
                                        placeholder="Enter Daily Rides" autocomplete="off">
                                </div>
                                <div class="col-md-5">
                                    <label for="Incentive" class="form-label">Incentive</label>
                                    <input type="text" class="form-control" name="Incentive[]"
                                        value="{{ old('Incentive.'.$key, $rides->Incentive) }}"
                                        placeholder="Enter Incentive" autocomplete="off">
                                </div>
                                <div class="col-md-2 text-end">
                                    <a href="{{ route('targeted.delete', ['id' => $rides->id]) }}" class="btn btn-danger">X</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="col-md-6 mb-3">
                            <label for="Daily_Rides" class="form-label">Daily Rides</label>
                            <input type="number" class="form-control" name="Daily_Rides[]" placeholder="Enter Daily Rides" autocomplete="off">
                            @if ($errors->has('Daily_Rides'))
                            <div class="text-danger">{{ $errors->first('Daily_Rides') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Incentive" class="form-label">Incentive</label>
                            <input type="text" class="form-control" name="Incentive[]" placeholder="Enter Incentive" autocomplete="off">
                            @if ($errors->has('Incentive'))
                            <div class="text-danger">{{ $errors->first('Incentive') }}</div>
                            @endif
                        </div>
                        <div id="dynamic-fields"></div>
                        @endif
                        <div class="col-md-12 mb-3">
                            <label for="Short_Description" class="form-label">Short Description</label>
                            <input type="text" class="form-control" name="Short_Description" placeholder="Enter Short Description" value="{{(isset($Targeted_ride)?$Targeted_ride->Short_Description:old('Short_Description'))}}" autocomplete="off">
                            @if ($errors->has('Short_Description'))
                            <div class="text-danger">{{ $errors->first('Short_Description') }}</div>
                            @endif
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Enabled" value="1"
                                    {{ (isset($Targeted_ride) && $Targeted_ride->Enabled == 1) ? 'checked' : '' }} id="Enabled">
                                <label class="form-check-label" for="Enabled">Enabled</label>
                            </div>
                            @if ($errors->has('Enabled'))
                            <div class="text-danger">{{ $errors->first('Enabled') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{(isset($Targeted_ride)? "Update Prominent Rides" : "Create Prominent Rides")}}</button>
                        <a href="{{ route('targeted.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-new-btn').on('click', function() {
            $('#dynamic-fields').append(`
                <div class="row mb-3 dynamic-field">
                    <div class="col-md-5">
                        <label for="Daily_Rides" class="form-label">Daily Rides</label>
                        <input type="number" class="form-control" name="Daily_Rides[]" placeholder="Enter Daily Rides" autocomplete="off">
                    </div>
                    <div class="col-md-5">
                        <label for="Incentive" class="form-label">Incentive</label>
                        <input type="text" class="form-control" name="Incentive[]" placeholder="Enter Incentive" autocomplete="off">
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-danger remove-btn">X</button>
                    </div>
                </div>
            `);
        });

        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.dynamic-field').remove();
        });
    });
</script>
@endsection