<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Categoría vinos') }}
        </h2>
    </x-slot>

    @include('wine.category.form', [
        'category' => $category,
        'action' => $action,
        'method' => $method,
        'submit' => $submit,
    ])
</x-app-layout>