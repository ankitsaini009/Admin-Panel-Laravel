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
                        <h4 class="card-title">Vehicle Type</h4>
                        <a href="{{ route('vehicle_type.create') }}" class="btn btn-primary">Create Vehicle Type</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Vehicle Type</th>
                                        <th>Created At</th>
                                        <th>Modified At</th>
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
                ajax: "{{ route('vehicle_type.index') }}",
                columns: [{
                        data: 'image',
                        name: 'image',
                        render: function(data) {
                            return "<img src='{{ asset('images/') }}/" + data + "' class='rounded-circle' width='85'>";
                        }
                    },
                    {
                        data: 'Vehicle_Type',
                        name: 'Vehicle_Type'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD MMMM YYYY hh:mm A');
                        }
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD MMMM YYYY hh:mm A');
                        }
                    },
                    {
                        data: 'Status',
                        name: 'Status',
                        render: function(data, type, row) {
                            return row.Status == 'active' ?
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