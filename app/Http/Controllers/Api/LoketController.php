<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loket;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Loket::query();

        // Search by name or type
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $lokets = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json($lokets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|string|max:10|unique:lokets,type',
            'description' => 'nullable|string|max:255',
        ]);

        $loket = Loket::create($data);

        return response()->json($loket, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loket $loket)
    {
        return response()->json($loket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loket $loket)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:50',
            'type' => 'sometimes|required|string|max:10|unique:lokets,type,' . $loket->id,
            'description' => 'nullable|string|max:255',
        ]);

        $loket->update($data);

        return response()->json($loket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loket $loket)
    {
        $loket->delete();

        return response()->json(['message' => 'Loket deleted successfully']);
    }
}
