@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 max-w-3xl">
        <h2 class="text-2xl font-bold mb-6">Редактировать тур</h2>

        {{-- Вывод ошибок --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Название тура --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Название тура</label>
                <input type="text" name="name" id="name" value="{{ old('name', $tour->name) }}"
                       class="w-full border rounded px-3 py-2 mt-1">
            </div>

            {{-- Описание --}}
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Описание</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border rounded px-3 py-2 mt-1">{{ old('description', $tour->description) }}</textarea>
            </div>

            {{-- Пользователь (организатор) --}}
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium">Организатор (User)</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2 mt-1">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $tour->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Локация --}}
            <div class="mb-4">
                <label for="location_id" class="block text-sm font-medium">Локация</label>
                <select name="location_id" id="location_id" class="w-full border rounded px-3 py-2 mt-1">
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $location->id == $tour->location_id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Цена --}}
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium">Цена (₸)</label>
                <input type="number" name="price" id="price" step="0.01"
                       value="{{ old('price', $tour->price) }}"
                       class="w-full border rounded px-3 py-2 mt-1">
            </div>

            {{-- Объем мест (volume) --}}
            <div class="mb-4">
                <label for="volume" class="block text-sm font-medium">Количество доступных мест</label>
                <input type="number" name="volume" id="volume"
                       value="{{ old('volume', $tour->volume) }}"
                       class="w-full border rounded px-3 py-2 mt-1">
            </div>

            {{-- Дата проведения --}}
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium">Дата тура</label>
                <input type="date" name="date" id="date"
                       value="{{ old('date', $tour->date ? \Carbon\Carbon::parse($tour->date)->format('Y-m-d') : '') }}"
                       class="w-full border rounded px-3 py-2 mt-1">
            </div>

            {{-- Изображение --}}
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium">Изображение тура</label>
                <input type="file" name="image" id="image"
                       class="w-full border rounded px-3 py-2 mt-1">

                @if ($tour->image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Текущее изображение:</p>
                        <img src="{{ asset('storage/' . $tour->image) }}" alt="Изображение тура"
                             class="w-48 rounded shadow mt-2">
                    </div>
                @endif
            </div>

            {{-- Кнопка сохранения --}}
            <div>
                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    Обновить тур
                </button>
            </div>
        </form>
    </div>
@endsection
