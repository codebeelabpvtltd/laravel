<!-- Include jQuery from a CDN -->
@extends('layouts.app')
@section('content')
<div class="container">

<form method="POST" id="employee-form"  enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
    <label for="employee_code" class="col-sm-2 col-form-label">Employee Code:</label>
    <input type="text" id="employee_code" class="form-control"  name="employee_code" value="EMP-0001" readonly>
</div>
<div class="mb-3">
    <label for="first_name" class="col-sm-2 col-form-label">First Name:</label>
    <input type="text" id="first_name" class="form-control"  name="first_name" required>
</div>
    <div class="mb-3">
    <label for="last_name" class="col-sm-2 col-form-label">Last Name:</label>
    <input type="text" id="last_name" class="form-control"  name="last_name" required>
</div>
    <div class="mb-3">
    <label for="joining_date" class="col-sm-2 col-form-label">Joining Date:</label>
    <input type="date" id="joining_date" class="form-control"  name="joining_date">
</div>
    <div class="mb-3">
    <div class="form-group">
        <label for="profile_image">Profile Image (Max 2MB):</label>
        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control">
        @error('profile_image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
    <input type="submit" class="btn btn-primary" value="Submit">
</form>
</div>

    <script>
    $(document).ready(function () {
        // Listen for form submission
        $('#employee-form').submit(function (event) {
            event.preventDefault(); // Prevent the default form submission
            var employeeCode = generateEmployeeCode();

// Add the employee code to the form data
$('input[name="employee_code"]').val(employeeCode);

            // Serialize form data to send via AJAX
            var formData = new FormData(this);

            // Send the AJAX request
            $.ajax({
                type: 'POST',
                url: '{{ route('employees.store') }}',
                data: formData,
                processData: false, // Prevent jQuery from processing data
                contentType: false, // Set content type to false for file uploads
                success: function (response) {
                    // Handle the success response (e.g., show success message)
                    console.log(response);
                    window.location.href = 'https://codexivesoftpro.com/laravel/public/employees';
                    // You can redirect or show a success message here
                },
                error: function (xhr, status, error) {
                    // Handle errors (e.g., display validation errors)
                    var errors = xhr.responseJSON;
                    console.log(errors);
                    // You can display validation errors here
                }
            });
        });
    });
    // Function to generate the employee code
function generateEmployeeCode() {
    // Implement your logic here to generate the code (e.g., fetch the latest code from the database)
    // For simplicity, you can use a counter or fetch the latest code from an API
    // Example: Fetch the latest code from an API or database
    var latestEmployeeCode = 'EMP-0001'; // Replace with your actual logic

    // Increment the code (e.g., EMP-0001 to EMP-0002)
    var codeParts = latestEmployeeCode.split('-');
    var codeNumber = parseInt(codeParts[1]) + 1;
    var newEmployeeCode = 'EMP-' + padCodeNumber(codeNumber);

    return newEmployeeCode;
}

// Function to pad the code number with leading zeros (e.g., 1 => 0001)
function padCodeNumber(number) {
    var str = number.toString();
    while (str.length < 4) {
        str = '0' + str;
    }
    return str;
}
</script>
@endsection
   