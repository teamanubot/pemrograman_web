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
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="aktif")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Status created"),
     *     @OA\Response(response=422, description="Validation failed")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
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
     *             @OA\Property(property="name", type="string")
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
            'name' => 'required|string|max:50',
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