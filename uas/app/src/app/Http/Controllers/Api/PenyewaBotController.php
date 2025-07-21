<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenyewaBot;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="PenyewaBot",
 *     description="Manajemen data penyewa bot"
 * )
 */
class PenyewaBotController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/everything/penyewa-bots",
     *     tags={"PenyewaBot"},
     *     summary="List all penyewa bots",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Response(response=200, description="List of penyewa bots")
     * )
     */
    public function index()
    {
        return PenyewaBot::all();
    }

    /**
     * @OA\Post(
     *     path="/api/everything/penyewa-bots",
     *     tags={"PenyewaBot"},
     *     summary="Create a new penyewa bot",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "product_id", "akun_id", "status_id", "expired_at"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="product_id", type="integer", example=2),
     *             @OA\Property(property="akun_id", type="integer", example=3),
     *             @OA\Property(property="status_id", type="integer", example=1),
     *             @OA\Property(property="expired_at", type="string", format="date-time", example="2025-12-31T23:59:59Z")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Penyewa bot created"),
     *     @OA\Response(response=422, description="Validation failed")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'akun_id' => 'required|integer|exists:akuns,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'expired_at' => 'required|date',
        ]);

        return response()->json(PenyewaBot::create($validated), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/everything/penyewa-bots/{id}",
     *     tags={"PenyewaBot"},
     *     summary="Get penyewa bot by ID",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Found"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return PenyewaBot::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/everything/penyewa-bots/{id}",
     *     tags={"PenyewaBot"},
     *     summary="Update penyewa bot",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="product_id", type="integer"),
     *             @OA\Property(property="akun_id", type="integer"),
     *             @OA\Property(property="status_id", type="integer"),
     *             @OA\Property(property="expired_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $penyewa = PenyewaBot::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id',
            'product_id' => 'sometimes|integer|exists:products,id',
            'akun_id' => 'sometimes|integer|exists:akuns,id',
            'status_id' => 'sometimes|integer|exists:statuses,id',
            'expired_at' => 'sometimes|date',
        ]);

        $penyewa->update($validated);
        return $penyewa;
    }

    /**
     * @OA\Delete(
     *     path="/api/everything/penyewa-bots/{id}",
     *     tags={"PenyewaBot"},
     *     summary="Delete penyewa bot",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $penyewa = PenyewaBot::findOrFail($id);
        $penyewa->delete();

        return response()->json(['message' => 'Penyewa bot deleted']);
    }
}