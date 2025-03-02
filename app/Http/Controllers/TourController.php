<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
class TourController extends Controller
{

    // 1. Получение всех туров
    public function index()
    {
        $tours = Tour::with(['user', 'location'])->get();
        return response()->json($tours);
    }

    // 2. Создание нового тура
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'location_id' => 'required|exists:locations,id',
            'price' => 'required|numeric|min:0',
            'volume' => 'required|integer|min:1',
            'date' => 'required|date',
            'image'=>'required|string'
        ]);

        $tour = Tour::create($validatedData);
        return response()->json(['message' => 'Tour created successfully!', 'tour' => $tour]);
    }

    // 3. Получение информации о конкретном туре
    public function show($id)
    {
        $tour = Tour::with(['user', 'location'])->findOrFail($id);
        return response()->json($tour);
    }

    // 4. Обновление тура
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'guide_id' => 'exists:users,id',
            'location_id' => 'exists:locations,id',
            'price' => 'numeric|min:0',
            'volume' => 'integer|min:1',
            'date' => 'date',
            'image'=>'string'
        ]);

        $tour = Tour::findOrFail($id);
        $tour->update($validatedData);
        return response()->json(['message' => 'Tour updated successfully!', 'tour' => $tour]);
    }

    // 5. Удаление тура
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        return response()->json(['message' => 'Tour deleted successfully!']);
    }

    // 6. Покупка тура (уменьшение volume)
    public function purchase(Request $request, $id)
    {
        $request->validate([
            'seats' => 'required|integer|min:1',
        ]);

        $tour = Tour::findOrFail($id);

        try {
            $tour->decreaseVolume($request->seats);
            return response()->json(['message' => 'Tour purchased successfully!', 'remaining_volume' => $tour->volume]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
