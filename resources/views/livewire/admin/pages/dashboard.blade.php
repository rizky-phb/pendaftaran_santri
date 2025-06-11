@if (auth()->user()->role !== 'admin')
    <script>window.location = "{{ url('/user') }}";</script>
@endif
<x-filament::page>
    <h1 class="text-2xl font-bold">Selamat datang di Dashboard Admin</h1>
    <p class="mt-2 text-gray-600">Statistik dan informasi penting bisa kamu tampilkan di sini.</p>
    
    <div>
        Jumlah Santri yang Diterima: {{ $this->getPendingBerkasCount() }}
    </div>

</x-filament::page>
