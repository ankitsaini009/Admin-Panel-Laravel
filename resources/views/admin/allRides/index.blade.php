@extends('admin.layout.main')

@section('manage_content')
<div class="content-body">
    <div class="container-fluid">
        <!-- Check for success messages -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">All Rides</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ride Id</th>
                                        <th>User Name</th>
                                        <th>Driver Name</th>
                                        <th>Amount</th>
                                        <th>Ride Type</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script type="text/javascript">
    var $jq = jQuery.noConflict();

    $jq(document).ready(function() {
        console.log('jQuery version:', $jq.fn.jquery);
        console.log('DataTables is available:', $jq.fn.DataTable ? 'Yes' : 'No');

        if ($jq.fn.DataTable) {
            $jq('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('allRide.index') }}",
                columns: [{
                        data: 'ride_id',
                        name: 'ride_id'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'driver_name',
                        name: 'driver_name'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'ride_type',
                        name: 'ride_type'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD MMMM YYYY hh:mm A');
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return row.status == 'active' ?
                                '<span class="btn btn-success btn-xs">Active</span>' :
                                '<span class="btn btn-danger btn-xs">Inactive</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        } else {
            console.error('DataTable function not available.');
        }
    });
</script>

@endsection