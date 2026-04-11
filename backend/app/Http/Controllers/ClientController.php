<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return response()->json($clients);
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

        $client = DB::transaction(function () use ($validatedData) {
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'gender' => $validatedData['gender'],
            ]);

            return Client::create(['client_id' => $user->id]);
        });

        $client->load('user');

        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load('user');
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'first_name' => 'sometimes|string|max:150',
            'last_name' => 'sometimes|string|max:100',
            'email' => 'sometimes|string|email|max:150|unique:users,email',
            'password' => 'sometimes|string|min:8',
            'gender' => 'sometimes|in:M,F,O',
        ]);
        $client->user->update($validatedData);
        return response()->json($client->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 200);
    }
}
