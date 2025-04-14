@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-12 bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div>
                @if($tour->image)
                    <img src="{{ asset('storage/' . $tour->image) }}" alt="Изображение тура" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-500 text-lg">Без изображения</div>
                @endif
            </div>

            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $tour->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $tour->description }}</p>

                <div class="space-y-3 text-gray-700">
                    <p><strong>Локация:</strong> {{ $tour->location->name ?? 'Не указано' }}</p>
                    <p><strong>Дата тура:</strong> {{ \Carbon\Carbon::parse($tour->date)->format('d.m.Y') }}</p>
                    <p><strong>Цена:</strong> {{ number_format($tour->price, 2) }} ₸</p>
                    <p><strong>Мест доступно:</strong> {{ $tour->volume }}</p>
                    <p><strong>Добавил тур:</strong> {{ $tour->user->name ?? 'Не указано' }}</p>
                </div>

                {{-- Кнопки редактирования и возврата --}}
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('tours.edit', $tour->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">✏️ Редактировать</a>
                    <a href="{{ route('tours.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">⬅ Назад к списку</a>

{{--                    @if(auth()->check())--}}
                        <div class="mt-8 border-t pt-6">
                            @if ($booking)
                                <p class="text-green-700 font-semibold mb-4">
                                    ✅ Вы уже забронировали этот тур.<br>
                                    Номер брони: <span class="font-bold">{{ $booking->id }}</span><br>
                                    Забронировано мест: <span class="font-bold">{{ $booking->seats }}</span>
                                </p>

                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите отменить бронь?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                        ❌ Отменить бронь
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                                    <div>
                                        <label for="seats" class="block text-sm font-medium text-gray-700 mb-1">Количество мест:</label>
                                        <input type="number" name="seats" id="seats" min="1" max="{{ $tour->volume }}" value="1" required
                                               class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                                    </div>

                                    @if(session('error'))
                                        <p class="text-red-600 text-sm">{{ session('error') }}</p>
                                    @endif

                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                                        ✅ Забронировать тур
                                    </button>
                                </form>
                            @endif
                        </div>
{{--                    @else--}}
{{--                        <div class="mt-8 border-t pt-6">--}}
{{--                            <p class="text-red-600 font-semibold">--}}
{{--                                ⚠ Пожалуйста, <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">войдите в систему</a>, чтобы забронировать тур.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    @endif--}}

                </div>
            </div>
        </div>
    </div>

@endsection
