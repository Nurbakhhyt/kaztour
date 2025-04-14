@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
        <h1 class="text-3xl font-bold mb-6">Добавить новый тур</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-semibold">Название тура</label>
                <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold">Описание</label>
                <textarea name="description" id="description" class="w-full border px-4 py-2 rounded" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="user_id" class="block font-semibold">Ответственный пользователь</label>
                <select name="user_id" id="user_id" class="w-full border px-4 py-2 rounded" required>
                    <option value="">-- Выберите пользователя --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="location_id" class="block font-semibold">Локация</label>
                <select name="location_id" id="location_id" class="w-full border px-4 py-2 rounded" required>
                    <option value="">-- Выберите локацию --</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-semibold">Цена (₸)</label>
                <input type="number" name="price" id="price" class="w-full border px-4 py-2 rounded" value="{{ old('price') }}" required min="0">
            </div>

            <div class="mb-4">
                <label for="volume" class="block font-semibold">Количество мест</label>
                <input type="number" name="volume" id="volume" class="w-full border px-4 py-2 rounded" value="{{ old('volume') }}" required min="1">
            </div>

            <div class="mb-4">
                <label for="date" class="block font-semibold">Дата проведения</label>
                <input type="date" name="date" id="date" class="w-full border px-4 py-2 rounded" value="{{ old('date') }}" required>
            </div>

            <div class="mb-6">
                <label for="image" class="block font-semibold">Изображение тура</label>
                <input type="file" name="image" id="image" class="w-full border px-4 py-2 rounded" accept="image/*" required>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('tours.index') }}" class="text-gray-600 hover:underline">← Назад к списку</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    ✅ Создать тур
                </button>
            </div>
        </form>
    </div>
@endsection
