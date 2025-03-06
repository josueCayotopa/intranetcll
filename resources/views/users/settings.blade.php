@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Configuración de Cuenta</h2>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-red-800">Guardar Cambios</button>
    </form>
</div>
@endsection
