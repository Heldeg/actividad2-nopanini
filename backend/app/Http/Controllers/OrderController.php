<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::paginate(5);
        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'total' => 'required|numeric',
            'type' => 'required|in:online,physical',
            'client_id' => 'nullable|exists:clients,client_id',
            'employee_id' => 'nullable|exists:employees,employee_id',
            'library_id' => 'required|exists:libraries,id',
        ]);

        $order = Order::create($validatedData);
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'total' => 'sometimes|numeric',
            'type' => 'sometimes|in:online,physical',
            'client_id' => 'sometimes|exists:clients,client_id',
            'employee_id' => 'sometimes|exists:employees,employee_id',
            'library_id' => 'sometimes|exists:libraries,id',
        ]);

        $order->update($validatedData);
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
