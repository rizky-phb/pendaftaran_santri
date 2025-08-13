@if (auth()->user()->role !== 'admin')
    <script>
        window.location = "{{ url('/user') }}";
    </script>
@endif

<x-filament::page>

    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Dashboard Admin</h1>
            <p class="text-gray-600 dark:text-gray-300">Pantauan real-time pendaftar dan progres pengisian data.</p>
        </div>

        {{-- Kotak Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @php
                $cards = [
                    [
                        'label' => 'Total Pendaftar',
                        'value' => $totalPendaftar,
                        'icon' => '👥',
                        'bg' => 'bg-blue-100',
                        'text' => 'text-blue-800',
                        'link' => '/admin/users?tableFilters[role][value]=user',
                    ],
                    [
                        'label' => 'Verifikasi Email',
                        'value' => $verifikasiEmail,
                        'icon' => '✅',
                        'bg' => 'bg-green-100',
                        'text' => 'text-green-800',
                        'link' => '/admin/users?tableFilters[role][value]=user',
                    ],
                    [
                        'label' => 'Lengkap Data Santri',
                        'value' => $lengkapSantri,
                        'icon' => '📄',
                        'bg' => 'bg-yellow-100',
                        'text' => 'text-yellow-800',
                        'link' => '/admin/verifikasi-berkas',
                    ],
                    [
                        'label' => 'Lengkap Data Ortu',
                        'value' => $lengkapOrtu,
                        'icon' => '👨‍👩‍👧',
                        'bg' => 'bg-purple-100',
                        'text' => 'text-purple-800',
                        'link' => '/admin/verifikasi-berkas',
                    ],
                    [
                        'label' => 'Upload Berkas Lengkap',
                        'value' => $lengkapBerkas,
                        'icon' => '📎',
                        'bg' => 'bg-pink-100',
                        'text' => 'text-pink-800',
                        'link' => '/admin/verifikasi-berkas',
                    ],
                    [
                        'label' => 'Sudah Bayar Lengkap',
                        'value' => $lunasPembayaran,
                        'icon' => '💰',
                        'bg' => 'bg-emerald-100',
                        'text' => 'text-emerald-800',
                        'link' => '/admin/pembayarans',
                    ],
                    [
                        'label' => 'Bayar Sebagian',
                        'value' => $parsialPembayaran,
                        'icon' => '💳',
                        'bg' => 'bg-orange-100',
                        'text' => 'text-orange-800',
                        'link' => '/admin/pembayarans',
                    ],
                    [
                        'label' => 'Sudah Diterima',
                        'value' => $masukPengumuman,
                        'icon' => '🎓',
                        'bg' => 'bg-indigo-100',
                        'text' => 'text-indigo-800',
                        'link' => '/admin/pengumumen',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <a href="{{ $card['link'] ?? '#' }}" class="block">
                    <div
                        class="p-5 rounded-xl border p-3 shadow-md transition-all duration-200 hover:scale-105
            {{ $card['bg'] }} {{ $card['text'] }} hover:bg-opacity-80">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold">{{ $card['label'] }}</span>
                            <span class="text-2xl">{{ $card['icon'] }}</span>
                        </div>
                        <div class="text-3xl font-bold">{{ $card['value'] }}</div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Chart --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                Statistik Visual Pendaftar Tahun {{ date('Y') }}
            </h2>
            <canvas id="pendaftarChart" height="150"></canvas>
        </div>
    </div>

    {{-- Chart JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function renderChart(isDark) {
            const ctx = document.getElementById('pendaftarChart').getContext('2d');

            if (window.pendaftarChartInstance) {
                window.pendaftarChartInstance.destroy();
            }

            window.pendaftarChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        'Pendaftar', 'Verifikasi Email', 'Data Santri', 'Data Ortu',
                        'Berkas', 'Bayar Lengkap', 'Bayar Sebagian', 'Penerimaan Santri'
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
                        borderRadius: 8
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
                            beginAtZero: true,
                            ticks: {
                                color: isDark ? '#ffffff' : '#000000'
                            }
                        }
                    }
                }
            });
        }

        const isDarkMode = () => document.documentElement.classList.contains('dark');

        renderChart(isDarkMode());

        const observer = new MutationObserver(() => {
            renderChart(isDarkMode());
        });

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class'],
        });
    </script>

</x-filament::page>
