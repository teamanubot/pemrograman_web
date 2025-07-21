<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Tag(
 *     name="Akuns",
 *     description="Manajemen akun pengguna bot"
 * )
 */
class AkunController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/everything/akuns",
     *     tags={"Akuns"},
     *     summary="List all Akuns",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Response(response=200, description="List of akuns")
     * )
     */
    public function index()
    {
        return Akun::all();
    }

    /**
     * @OA\Post(
     *     path="/api/everything/akuns",
     *     tags={"Akuns"},
     *     summary="Create a new Akun",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "whatsapp_number", "password"},
     *             @OA\Property(property="name", type="string", example="Jane Doe"),
     *             @OA\Property(property="email", type="string", example="jane@example.com"),
     *             @OA\Property(property="whatsapp_number", type="string", example="628123456789"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Akun created successfully"),
     *     @OA\Response(response=422, description="Validation failed")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:akuns',
            'whatsapp_number' => 'required|string|max:20|unique:akuns',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        return response()->json(Akun::create($validated), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/everything/akuns/{id}",
     *     tags={"Akuns"},
     *     summary="Get Akun by ID",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Akun found"),
     *     @OA\Response(response=404, description="Akun not found")
     * )
     */
    public function show($id)
    {
        return Akun::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/everything/akuns/{id}",
     *     tags={"Akuns"},
     *     summary="Update Akun",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="whatsapp_number", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Akun updated"),
     *     @OA\Response(response=404, description="Akun not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:akuns,email,' . $id,
            'whatsapp_number' => 'sometimes|string|max:20|unique:akuns,whatsapp_number,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $akun->update($validated);
        return response()->json($akun);
    }

    /**
     * @OA\Delete(
     *     path="/api/everything/akuns/{id}",
     *     tags={"Akuns"},
     *     summary="Delete Akun",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Akun deleted"),
     *     @OA\Response(response=404, description="Akun not found")
     * )
     */
    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return response()->json(['message' => 'Akun deleted']);
    }
}
