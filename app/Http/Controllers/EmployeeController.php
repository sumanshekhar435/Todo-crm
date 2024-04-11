<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Passport;

class EmployeeController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:employees',
                'phone' => 'nullable|string|regex:/^[0-9]{10}$/|min:10|max:10',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['message' => 'Employee registered successfully', 'employee' => $employee]);
        } catch (ValidationException $e) {
            // Validation errors occurred, return response with validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (QueryException $e) {
            // Database query exception occurred, return response with error message
            return response()->json(['error' => 'Failed to register employee'], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            // Attempt to authenticate the employee
            if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // Get the authenticated user
                $user = Auth::guard('employee')->user();
                
                // Revoke existing tokens if any
                $user->tokens()->delete();
    
                // Create a new token
                $token = $user->createToken('API Token')->accessToken;
                unset($user->password);
                // Return a JSON response with the generated API token
                return response()->json(['status' => 'success' , 'data' => $user ,'token' => $token]);
            } else {
                // Authentication failed, return a JSON response with error message
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
        } catch (ValidationException $e) {
            // Validation errors occurred, return response with validation errors
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Other exceptions occurred, return response with error message
            return response()->json(['error' => 'Failed to log in.'], 500);
        }
    }

    public function show(){
        $employee = Employee::orderBy('created_at', 'desc')->get();
        return response()->json(['status' => true, 'data' => $employee], 200);
    }

    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();
        return view('pages.employees.employees', compact('employees'));
    }

    public function create()
    {
        return view('pages.employees.add-employee');
    }

    public function store(Request $request)
    {
        // Manually validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|regex:/^[0-9]{10}$/|min:10|max:10',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Add an error message for password confirmation failure
        $validator->sometimes('password_confirmation', 'required|string|min:8', function ($input) {
            return $input->password;
        });

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back with errors and input data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, proceed with creating the user
        try {
            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // Redirect back with success message
            return redirect()->route('employees')->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            // Log::error($e);

            // Redirect back with error message
            return redirect()->back()->with('error', 'Oops! Something went wrong while creating employee...');
        }
    }

    public function edit($id)
    {

        $employee =    Employee::findOrFail(Crypt::decrypt($id));

        return view('pages.employees.edit-employee', compact('employee'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->employee_id,
            'phone' => 'nullable|string|regex:/^[0-9]{10}$/|min:10|max:10',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Add an error message for password confirmation failure
        $validator->sometimes('password_confirmation', 'required|string|min:8', function ($input) {
            return $input->password;
        });

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, redirect back with errors and input data
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, proceed with updating the employee
        try {
            $employee = Employee::findOrFail($request->employee_id);
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;

            // Update password if provided
            if ($request->filled('password')) {
                $employee->password = Hash::make($request->password);
            }

            $employee->save();

            // Redirect back with success message
            return redirect()->route('employees')->with('success', 'Employee updated successfully');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            // Log::error($e);

            // Redirect back with error message
            return redirect()->back()->with('error', 'Oops! Something went wrong while updating employee...');
        }
    }


    public function destroy($id)
    {
        $project = Employee::where('id', Crypt::decrypt($id))->delete();
        return redirect()->route('employees')->with('success', 'Employee details delete successfully');
    }
}
