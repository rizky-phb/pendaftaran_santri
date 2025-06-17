<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
        @livewire('database-notifications')
    </flux:main>
</x-layouts.app.sidebar>
