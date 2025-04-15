<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'seats' => 'required|integer|min:1'
        ]);

        $tour = Tour::findOrFail($data['tour_id']);

        if ($tour->volume < $data['seats']) {
            return redirect()->back()->with('error', 'Недостаточно мест для бронирования.');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'tour_id' => $tour->id,
            'seats' => $data['seats']
        ]);

        $tour->decreaseVolume($data['seats']);

        return redirect()->route('tours.index')->with('success', 'Тур успешно забронирован!');
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $tour = $booking->tour;
        $tour->volume += $booking->seats;
        $tour->save();

        $booking->delete();

        return redirect()->route('tours.index')->with('success', 'Бронь успешно отменена.');
    }

}
