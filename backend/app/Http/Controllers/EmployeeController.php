<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(5);
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:users,email',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:M,F,O',
            'dni' => 'required|string|max:100|unique:employees,dni',
            'tel_number' => 'required|string|max:200',
            'bank_account' => 'required|string|max:200',
        ]);

        $employee = DB::transaction(function () use ($validatedData) {
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'gender' => $validatedData['gender'],
            ]);


            return Employee::create([
                'employee_id' => $user->id,
                'dni' => $validatedData['dni'],
                'tel_number' => $validatedData['tel_number'],
                'bank_account' => $validatedData['bank_account']
            ]);
        });

        $employee->load('user');

        return response()->json($employee, 201);
    }

    public function promote(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'dni' => 'required|string|max:100|unique:employees,dni',
            'tel_number' => 'required|string|max:200',
            'bank_account' => 'required|string|max:200',
        ]);

        $employee = Employee::firstOrCreate(
            ['employee_id' => $request->user_id], // Qué buscar
            [
                'dni' => $validatedData['dni'],
                'tel_number' => $validatedData['tel_number'],
                'bank_account' => $validatedData['bank_account']
            ] 
        );

        return response()->json([
            'message' => 'User promoted to employee successfully',
            'data' => $employee->load('user')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load('user');
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
{
    $validatedData = $request->validate([
        'first_name' => 'sometimes|string|max:150',
        'last_name'  => 'sometimes|string|max:100',
        'email'      => ['sometimes', 'string', 'email', 'max:150', Rule::unique('users')->ignore($employee->user->id)],
        'password'   => 'sometimes|string|min:8',
        'gender'     => 'sometimes|in:M,F,O',
        'dni'        => ['sometimes', 'string', 'max:100', Rule::unique('employees')->ignore($employee->employee_id, 'employee_id')],
        'tel_number' => 'sometimes|string|max:200',
        'bank_account'=> 'sometimes|string|max:200',
    ]);

    DB::transaction(function () use ($validatedData, $employee) {
        
        $userData = collect($validatedData)->only(['first_name', 'last_name', 'email', 'password', 'gender'])->toArray();
        if (!empty($userData)) {
            $employee->user->update($userData);
        }

        $employeeData = collect($validatedData)->only(['dni', 'tel_number', 'bank_account'])->toArray();
        if (!empty($employeeData)) {
            $employee->update($employeeData);
        }
    });

    return response()->json($employee->load('user'));
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}
