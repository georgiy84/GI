<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        return Alert::with(['product', 'user'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'alert_type' => 'required|in:email,sms,whatsapp',
            'message' => 'required|string',
        ]);

        $alert = Alert::create($validated);
        return response()->json($alert, 201);
    }

    public function show(Alert $alert)
    {
        return $alert->load(['product', 'user']);
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();
        return response()->json(null, 204);
    }
}
