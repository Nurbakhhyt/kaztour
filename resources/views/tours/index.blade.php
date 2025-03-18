@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
        <h1 class="text-3xl font-bold mb-6">Список туров</h1>

        <div class="mb-4 text-right">
            <a href="{{ route('tours.store') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ➕ Добавить тур
            </a>
        </div>

        <table class="min-w-full border border-gray-300 rounded overflow-hidden">
            <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">#</th>
                <th class="border px-4 py-2 text-left">Название</th>
                <th class="border px-4 py-2 text-left">Локация</th>
                <th class="border px-4 py-2 text-left">Дата</th>
                <th class="border px-4 py-2 text-left">Цена (₸)</th>
                <th class="border px-4 py-2 text-left">Места</th>
                <th class="border px-4 py-2 text-left">Действия</th>
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
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">👁️ Просмотр</a>

                        <a href="{{ route('tours.edit', $tour->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">✏️ Редактировать</a>

                        <form action="{{ route('tours.destroy', $tour->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Вы уверены, что хотите удалить этот тур?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                🗑️ Удалить
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
@endsection
