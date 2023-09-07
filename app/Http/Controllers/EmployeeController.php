<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use DataTables; 
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
	public function create()
{
    return view('employees.create');
}

public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'joining_date' => 'nullable|date',
        'profile_image' => 'nullable|image|max:2048',
    ]);
    $latestEmployee = Employee::latest('employee_code')->first();

if ($latestEmployee) {
    // Extract the numeric part of the latest employee code and increment it
    $codeParts = explode('-', $latestEmployee->employee_code);
   print_r( $codeParts );
    // Check if $codeParts has at least two elements
    if (isset($codeParts[1])) {
        $codeNumber = intval($codeParts[1]) + 1;
    }
     else {
        // Handle the case where the employee code format is unexpected
        // You may want to log an error or take another appropriate action
        $codeNumber = 0; // Default to 0 or any other suitable value
    }
    
    $newEmployeeCode = 'EMP-' . str_pad($codeNumber, 4, '0', STR_PAD_LEFT);
} else {
    // If no records exist, start with EMP-0000
    $newEmployeeCode = 'EMP-0000';
}
    $employee = new Employee();
    $employee->employee_code = $newEmployeeCode;// You can implement your own logic for generating employee codes
    $employee->first_name = $request->input('first_name');
    $employee->last_name = $request->input('last_name');
    $employee->joining_date = $request->input('joining_date');
   
    
    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profile_images');
        $employee->profile_image = $imagePath;
    }

    $employee->save();

    //return redirect('/laravel/public/employees');
}

public function getEmployeesData(Request $request)
{
    $employees = Employee::select(['employee_code', 'first_name', 'last_name', 'joining_date', 'profile_image']);

    // Filter by date range if start and end dates are provided
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $employees->whereBetween('joining_date', [$start_date, $end_date]);
    }

    return DataTables::of($employees)->make(true);

}
public function index(Request $request)
{
    return view('employees.index');
}


}
