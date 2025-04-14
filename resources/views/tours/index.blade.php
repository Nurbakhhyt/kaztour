@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
        <form method="GET" action="{{ route('tours.index') }}" class="mb-6 bg-white p-4 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="search" name="name" value="{{ request('name') }}" placeholder="🔍 Поиск по названию тура" class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

            <div class="flex gap-2">
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="border rounded px-3 py-2 w-1/2" placeholder="Дата до">
            </div>

            <div class="flex gap-2">
                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Макс. цена" class="border rounded px-3 py-2 w-1/2">
            </div>

            <div class="flex gap-2">
                <input type="number" name="volume_max" value="{{ request('volume_max') }}" placeholder="Макс. мест" class="border rounded px-3 py-2 w-1/2">
            </div>

            <select name="user_id" class="border rounded px-3 py-2">
                <option value="">Добавил пользователь</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if(request('user_id') == $user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>

            <select name="location_id" class="border rounded px-3 py-2">
                <option value="">Локация</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" @if(request('location_id') == $location->id) selected @endif>{{ $location->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">🔍 Применить фильтр</button>
        </form>


        <h1 class="text-3xl font-bold mb-6 text-center">Список туров</h1>

        <div class="mb-4 text-right">
            <a href="{{ route('tours.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ➕ Добавить тур
            </a>
        </div>

        {{-- Центрируем таблицу --}}
        <div class="flex justify-center">
            <table class="w-full max-w-5xl border border-gray-300 rounded overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">#</th>
                    <th class="border px-4 py-2 text-left">Название</th>
                    <th class="border px-4 py-2 text-left">Локация</th>
                    <th class="border px-4 py-2 text-left">Дата</th>
                    <th class="border px-4 py-2 text-left">Цена (₸)</th>
                    <th class="border px-4 py-2 text-left">Места</th>
                    <th class="border px-4 py-2 text-left">Подробнее</th>
                    <th class="border px-4 py-2 text-left">Редактировать</th>
                    <th class="border px-4 py-2 text-left">Удалить</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tours as $tour)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $tour->name }}</td>
                        <td class="border px-4 py-2">{{ $tour->location->name ?? 'Не указано' }}</td>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($tour->date)->format('d.m.Y') }}</td>
                        <td class="border px-4 py-2">{{ number_format($tour->price, 2) }}</td>
                        <td class="border px-4 py-2">{{ $tour->volume }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('tours.show', $tour->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    👁️
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('tours.edit', $tour->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    ✏️
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('tours.destroy', $tour->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Вы уверены, что хотите удалить этот тур?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Туры не найдены.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
