<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return response()->json($cities, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpg,jpeg,png,gif|max:5000',
            'description' => 'required|string',
            'city_code' => 'required|max:3'
        ]);

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('cities', 'public');
            $validated['img'] = $imagePath;
        }

        $city = City::create($validated);
        return response()->json($city, 201);
    }

    public function show(string $id)
    {
        $city = City::find($id);
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }
        return response()->json($city, 200);
    }

    public function update(Request $request, string $id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
            'description' => 'required|string',
            'city_code' => 'required|max:3'
        ]);

        if ($request->hasFile('img')) {
            Storage::disk('public')->delete($city->img);
            $imagePath = $request->file('img')->store('cities', 'public');
            $validated['img'] = $imagePath;
        }

        $city->update($validated);
        return response()->json($city, 200);
    }

    public function destroy(string $id)
    {
        $city = City::find($id);
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        Storage::disk('public')->delete($city->img);
        $city->delete();

        return response()->json(['message' => 'City deleted successfully'], 200);
    }
}
