<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(5);
        return response()->json($admins);
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
        ]);

        $admin = DB::transaction(function () use ($validatedData) {
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'gender' => $validatedData['gender'],
            ]);

            return Admin::create(['admin_id' => $user->id]);
        });

        $admin->load('user');

        return response()->json($admin, 201);
    }

    public function promote(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $admin = Admin::firstOrCreate([
            'admin_id' => $request->user_id
        ]);

        return response()->json([
        'message' => 'User promoted to admin successfully.',
        'data' => $admin->load('user')
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $admin->load('user');
        return response()->json($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validatedData = $request->validate([
            'first_name' => 'sometimes|string|max:150',
            'last_name' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:150|unique:users,email',
            'password' => 'sometimes|string|min:8',
            'gender' => 'sometimes|in:M,F,O',
        ]);
        $admin->user->update($validatedData);
        return response()->json($admin->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}
