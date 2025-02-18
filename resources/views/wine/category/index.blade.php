<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorías de Vinos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a 
                        href="{{ route('categories.create') }}" 
                        class="bg-purple-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        {{ 'Crear Categoría' }}
                    </a>

                    @if ($categories->isNotEmpty())
                        <!-- Asegúrate de que la cuadrícula esté correctamente configurada -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                            @foreach ($categories as $category)
                                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <!-- Imagen de la categoría -->
                                    <img
                                        class="object-cover w-full h-48 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                        src="{{ $category->image_url }}"
                                        alt="{{ $category->name }}"
                                    />
                                    <div class="p-4">
                                        <!-- Nombre y descripción de la categoría -->
                                        <h5 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ $category->name }}
                                        </h5>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->description }}</p>
                                        <span class="text-sm font-normal text-gray-500 dark:text-white">{{ $category->wines_count }} Vinos</span>

                                        <div class="mt-4 flex space-x-2">
                                            <a 
                                                href="{{ route('categories.edit', $category) }}" 
                                                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-1 px-3 rounded">
                                                Editar
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{ '¡Lo siento!' }}</strong>
                            <span class="block sm:inline">{{ 'No hay categorías de vino creadas' }}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
