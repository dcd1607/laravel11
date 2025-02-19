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
                        href="{{ route('wines.create') }}" 
                        class="bg-purple-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        {{ 'Crear Vino' }}
                    </a>

                    @if ($wines->isNotEmpty())
                        <!-- Asegúrate de que la cuadrícula esté correctamente configurada -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                            @foreach ($wines as $wine)
                                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <x-wine-image :wine="$wine" />
                                    <div class="flex flex-col p-4 leading-normal flex-grow">
                                        <x-wine-name-and-category :wine="$wine" />
                                        <div class="border-b border-gray-300 dark:border-gray-600 mb-4"></div>
                                        <x-wine-info :wine="$wine" />
                                        <div class="mt-auto flex justify-center space-x-2 w-full">
                                            <a 
                                                href="{{ route('wines.edit', $wine) }}" 
                                                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-1 px-3 rounded">
                                                Editar
                                            </a>
                                            <form action="{{ route('wines.destroy', $wine) }}" method="POST">
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
                            <span class="block sm:inline">{{ 'No hay vinos creados' }}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>