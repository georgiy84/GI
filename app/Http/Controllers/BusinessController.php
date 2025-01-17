<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function __construct()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $this->middleware('auth:sanctum');
    }
    
    // Obtener todas las empresas del usuario autenticado
    public function index()
    {
        return Business::where('user_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:businesses',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Obtener el ID del usuario autenticado
            $userId = auth()->id();

            // Construir la ruta del directorio
            $directory = "users/$userId/logos";

            // Crear el directorio si no existe
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Guardar el archivo en el directorio
            $logoPath = $request->file('logo')->store($directory, 'public');
            $validated['logo'] = $logoPath;
        }

        // Asignar el ID del usuario autenticado al negocio
        $validated['user_id'] = auth()->id();

        $business = Business::create($validated);
        return response()->json($business, 201);
    }


    // Mostrar un negocio específico
    public function show(Business $business)
    {
        // Asegurarse de que el negocio pertenece al usuario autenticado
        if ($business->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($business, 200);
    }

    // Actualizar un negocio existente
    public function update(Request $request, Business $business)
    {
        // Asegurarse de que el negocio pertenece al usuario autenticado
        if ($business->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:businesses,email,' . $business->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Directorio personalizado por usuario
        $userId = Auth::id();
        $directoryPath = "users/{$userId}/logos";

        // Verifica si el directorio existe, si no, lo crea
        if (!Storage::disk('public')->exists($directoryPath)) {
            Storage::disk('public')->makeDirectory($directoryPath);
        }

        // Guardar el nuevo logo si se proporciona
        if ($request->hasFile('logo')) {
            // Eliminar el logo anterior si existe
            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }

            // Guardar el nuevo logo
            $logoPath = $request->file('logo')->store($directoryPath, 'public');
            $validated['logo'] = $logoPath;
        }

        $business->update($validated);
        return response()->json($business, 200);
    }

    // Eliminar un negocio
    public function destroy(Business $business)
    {
        // Asegurarse de que el negocio pertenece al usuario autenticado
        if ($business->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Eliminar el logo del sistema de archivos si existe
        if ($business->logo) {
            Storage::disk('public')->delete($business->logo);
        }

        // Eliminar el negocio de la base de datos
        $business->delete();

        return response()->json(null, 204);
    }
}
