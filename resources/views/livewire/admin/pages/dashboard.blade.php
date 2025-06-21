@if (auth()->user()->role !== 'admin')
    <script>window.location = "{{ url('/user') }}";</script>
@endif

<x-filament::page>
    <h1 class="text-2xl font-bold mb-2 text-gray-900 dark:text-gray-100">Dashboard Admin</h1>
    <p class="mb-6 text-gray-600 dark:text-gray-300">Pantauan real-time pendaftar dan progres pengisian data.</p>

    {{-- Kotak Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Total Pendaftar</div>
            <div class="text-2xl font-bold">{{ $totalPendaftar }}</div>
        </x-filament::card>

        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Sudah Verifikasi Email</div>
            <div class="text-2xl font-bold">{{ $verifikasiEmail }}</div>
        </x-filament::card>

        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Lengkap Data Santri</div>
            <div class="text-2xl font-bold">{{ $lengkapSantri }}</div>
        </x-filament::card>

        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Lengkap Data Orang Tua</div>
            <div class="text-2xl font-bold">{{ $lengkapOrtu }}</div>
        </x-filament::card>

        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Upload Berkas Lengkap</div>
            <div class="text-2xl font-bold">{{ $lengkapBerkas }}</div>
        </x-filament::card>

        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Sudah Bayar Lengkap</div>
            <div class="text-2xl font-bold">{{ $lunasPembayaran }}</div>
        </x-filament::card>

        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Bayar Sebagian</div>
            <div class="text-2xl font-bold">{{ $parsialPembayaran }}</div>
        </x-filament::card>

        <x-filament::card class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
            <div class="text-sm text-gray-500 dark:text-gray-400">Sudah Diumumkan</div>
            <div class="text-2xl font-bold">{{ $masukPengumuman }}</div>
        </x-filament::card>
    </div>

    {{-- Chart --}}
    <div class="shadow rounded-lg p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <h2 class="text-xl font-bold mb-4">Statistik Visual Pendaftar</h2>
        <canvas id="pendaftarChart" height="150"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function renderChart(isDark) {
            const ctx = document.getElementById('pendaftarChart').getContext('2d');

            // Hancurkan chart sebelumnya jika ada
            if (window.pendaftarChartInstance) {
                window.pendaftarChartInstance.destroy();
            }

            window.pendaftarChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        'Pendaftar', 'Verifikasi Email', 'Data Santri', 'Data Ortu',
                        'Berkas', 'Bayar Lengkap', 'Bayar Sebagian', 'Pengumuman'
                    ],
                    datasets: [{
                        label: 'Jumlah',
                        data: [
                            {{ $totalPendaftar }},
                            {{ $verifikasiEmail }},
                            {{ $lengkapSantri }},
                            {{ $lengkapOrtu }},
                            {{ $lengkapBerkas }},
                            {{ $lunasPembayaran }},
                            {{ $parsialPembayaran }},
                            {{ $masukPengumuman }}
                        ],
                        backgroundColor: [
                            '#3b82f6', '#10b981', '#f59e0b', '#6366f1',
                            '#ec4899', '#22c55e', '#eab308', '#8b5cf6'
                        ],
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            labels: {
                                color: isDark ? '#ffffff' : '#000000'
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: isDark ? '#ffffff' : '#000000'
                            }
                        },
                        y: {
                            ticks: {
                                color: isDark ? '#ffffff' : '#000000'
                            }
                        }
                    }
                }
            });
        }
    </script>
<script>
    // Deteksi apakah tema sekarang dark
    const isDarkMode = () => document.documentElement.classList.contains('dark');

    // Render pertama kali
    renderChart(isDarkMode());

    // Pantau perubahan tema (jika ada sistem toggle atau preferensi)
    const observer = new MutationObserver(() => {
        renderChart(isDarkMode());
    });

    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class'],
    });
</script>

</x-filament::page>
