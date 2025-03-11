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
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'volume' => 'required|integer|min:1',
            'date' => 'required|date',
            'user_id' => 'nullable|exists:users,id',
            'location_id' => 'nullable|exists:locations,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tours', 'public');
            $validatedData['image'] = $imagePath;
        }

        Tour::create($validatedData);


        return response()->json(['message' => 'Tour created successfully'], 201);
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
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'guide_id' => 'sometimes|exists:users,id',
            'location_id' => 'sometimes|exists:locations,id',
            'price' => 'sometimes|numeric|min:0',
            'volume' => 'sometimes|integer|min:1',
            'date' => 'sometimes|date',
            'image' => 'sometimes|file|mimes:jpeg,png,jpg|max:2048'
        ]);

        $tour = Tour::findOrFail($id);

        // Егер жаңа сурет жүктелсе, оны сақтау
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $validatedData['image'] = $imagePath;
        }

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
