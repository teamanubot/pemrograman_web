<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Statuses",
 *     description="Manajemen status langganan bot"
 * )
 */
class StatusController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/everything/statuses",
     *     tags={"Statuses"},
     *     summary="List all statuses",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Response(response=200, description="List of statuses")
     * )
     */
    public function index()
    {
        return Status::all();
    }

    /**
     * @OA\Post(
     *     path="/api/everything/statuses",
     *     tags={"Statuses"},
     *     summary="Create a new status",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"akun_id", "nama", "subscription_type", "price"},
     *             @OA\Property(property="akun_id", type="integer", example=1),
     *             @OA\Property(property="nama", type="string", example="aktif"),
     *             @OA\Property(property="whatsapp_number", type="string", example="6281234567890"),
     *             @OA\Property(property="subscription_type", type="string", enum={"selfbot", "official bot"}),
     *             @OA\Property(property="payment_status", type="string", enum={"pending", "approved", "rejected"}, example="pending"),
     *             @OA\Property(property="payment_transaction_id", type="integer", nullable=true),
     *             @OA\Property(property="price", type="number", format="float", example=150000)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Status created"),
     *     @OA\Response(response=422, description="Validation failed")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'akun_id' => 'required|exists:akuns,id',
            'nama' => 'required|string|max:50',
            'whatsapp_number' => 'nullable|string|max:20',
            'subscription_type' => 'required|in:selfbot,official bot',
            'payment_status' => 'nullable|in:pending,approved,rejected',
            'payment_transaction_id' => 'nullable|exists:payment_transactions,id',
            'price' => 'required|numeric|min:0',
        ]);

        return response()->json(Status::create($validated), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/everything/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Get status by ID",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Found"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return Status::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/everything/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Update status",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string"),
     *             @OA\Property(property="whatsapp_number", type="string"),
     *             @OA\Property(property="subscription_type", type="string", enum={"selfbot", "official bot"}),
     *             @OA\Property(property="payment_status", type="string", enum={"pending", "approved", "rejected"}),
     *             @OA\Property(property="payment_transaction_id", type="integer"),
     *             @OA\Property(property="price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'whatsapp_number' => 'nullable|string|max:20',
            'subscription_type' => 'required|in:selfbot,official bot',
            'payment_status' => 'nullable|in:pending,approved,rejected',
            'payment_transaction_id' => 'nullable|exists:payment_transactions,id',
            'price' => 'required|numeric|min:0',
        ]);

        $status->update($validated);
        return $status;
    }

    /**
     * @OA\Delete(
     *     path="/api/everything/statuses/{id}",
     *     tags={"Statuses"},
     *     summary="Delete status",
     *     security={{"ApiKeyAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return response()->json(['message' => 'Status deleted']);
    }
}