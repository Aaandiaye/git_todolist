{{--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Vous êtes connecté !") }}
                    <br>
                    <a href="{{ route('taches.index') }}" class="text-gray-500 hover:text-red-950">Retour à la liste tâches</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>--}}



<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 shadow-xl sm:rounded-lg p-8">
                <div class="text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">{{ __("Bienvenue sur votre tableau de bord !") }}</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Section 1 : Lien vers la gestion des tâches -->
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h4 class="text-xl font-semibold text-gray-700 mb-2">Gestion des tâches</h4>
                            <p class="text-gray-600 mb-4">Accédez à la liste de toutes vos tâches et gérez-les facilement.</p>
                            <a href="{{ route('taches.index') }}" class="btn btn-secondary">
                                Voir la liste des tâches
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
