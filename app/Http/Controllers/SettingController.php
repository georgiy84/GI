<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return Setting::with('business')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'notify_email' => 'required|boolean',
            'notify_sms' => 'required|boolean',
            'notify_whatsapp' => 'required|boolean',
        ]);

        $setting = Setting::create($validated);
        return response()->json($setting, 201);
    }

    public function show(Setting $setting)
    {
        return $setting->load('business');
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'notify_email' => 'sometimes|required|boolean',
            'notify_sms' => 'sometimes|required|boolean',
            'notify_whatsapp' => 'sometimes|required|boolean',
        ]);

        $setting->update($validated);
        return response()->json($setting, 200);
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return response()->json(null, 204);
    }
}
