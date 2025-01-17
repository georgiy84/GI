<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use Illuminate\Http\Request;

class InventoryLogController extends Controller
{
    public function index()
    {
        return InventoryLog::with(['product', 'user'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'scanned_barcode' => 'nullable|string',
        ]);

        $log = InventoryLog::create($validated);
        return response()->json($log, 201);
    }

    public function show(InventoryLog $inventoryLog)
    {
        return $inventoryLog->load(['product', 'user']);
    }

    public function destroy(InventoryLog $inventoryLog)
    {
        $inventoryLog->delete();
        return response()->json(null, 204);
    }
}
