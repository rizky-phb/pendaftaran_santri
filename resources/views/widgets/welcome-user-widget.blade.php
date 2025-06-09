<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold">Selamat datang, {{ auth()->user()->name }}</h2>
        <p>Anda login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-4 flex justify-end">
            @csrf
            <button type="submit" class="flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
            <span class="mr-2">Logout</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
            </svg>
            </button>
        </form>
    </x-filament::card>
</x-filament::widget>
