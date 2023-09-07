<!-- Include DataTables CSS -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center">Employee Data</h1>
    
    <div class="container">
    <!-- First Row -->
    <div class="row align-items-start">
        <div class="col-md-4 text-start"> <!-- Apply 'text-center' class for horizontal alignment -->
            <div class="form-group mt-3">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" class="form-control">
            </div>
        </div>
   

    <!-- Second Row -->
  
        <div class="col-md-4 text-start"> <!-- Apply 'text-center' class for horizontal alignment -->
            <div class="form-group mt-3">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" class="form-control">
            </div>
        </div>
  

    <!-- Third Row -->
    
        <div class="col-md-4 text-center"> <!-- Apply 'text-center' class for horizontal alignment -->
            <div class="form-group mt-3">
                <button id="filter-btn" class="btn btn-primary">Apply Filter</button>
            </div>
        </div>
    </div>
</div>


    <!-- DataTable container -->
    <table id="employee-table" class="table">
        <thead>
            <!-- Define your table headers here -->
            <tr>
                <th>Employee Code</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Joining Date</th>
                <th>Profile Image</th>
            </tr>
        </thead>
        <tbody>
            <!-- DataTable rows will be loaded here via AJAX -->
        </tbody>
    </table>
</div>


<!-- Include DataTables JS -->


    <script>
    $(document).ready(function () {
        var table = $('#employee-table').DataTable({
            paging: true, // Disable initial pagination
            searching: true,
            processing: true,
            serverSide: true, // Enable server-side processing
            ajax: {
                url: '/laravel/public/employees/data',
                data: function (d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [
                // Define your table columns here
                { data: 'employee_code', name: 'employee_code' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'joining_date', name: 'joining_date' },
                {
                    data: 'profile_image',
                    name: 'profile_image',
                    render: function (data, type, full, meta) {
                        if (type === 'display' && data) {
                            return '<img src="/laravel/storage/app/' + data + '" alt="Profile Image" width="50">';
                        } else {
                            return 'No Image';
                        }
                    },
                },
            ],
        });

        // Add event listeners to filter by date range
        $('#filter-btn').click(function () {
            table.draw();
        });

        // Load all records initially
        table.ajax.reload();
    });
</script>
@endsection
   