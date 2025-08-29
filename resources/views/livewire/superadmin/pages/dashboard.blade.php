@if (auth()->user()->role !== 'admin')
    <script>
        window.location = "{{ url('/user') }}";
    </script>
@endif

<x-filament::page>
    <style>
        @keyframes slideInUp {
          from {
            transform: translateY(30px);
            opacity: 0;
          }
          to {
            transform: translateY(0);
            opacity: 1;
          }
        }
        .animate-slide-in-up {
          animation: slideInUp 0.8s ease-out forwards;
        }
        </style>
        
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2 animate-slide-in-up">
                Dashboard Admin
            </h1>
            <p class="text-gray-600 dark:text-gray-300 animate-slide-in-up" style="animation-delay: 0.3s;">
                Pantauan real-time pendaftar dan progres pengisian data.
            </p>
            
        </div>

        {{-- Kotak Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @php
                $total = max(1, $totalPendaftar); // supaya progress bisa dihitung
                $cards = [
                    ['label'=>'Total Pendaftar','value'=>1000,'icon'=>'👥','bg'=>'bg-blue-100','text'=>'text-blue-800','link'=>'/admin/users?tableFilters[role][value]=user'],
                    ['label'=>'Verifikasi Email','value'=>821,'icon'=>'✅','bg'=>'bg-green-100','text'=>'text-green-800','link'=>'/admin/users?tableFilters[role][value]=user'],
                    ['label'=>'Lengkap Data Santri','value'=>711,'icon'=>'📄','bg'=>'bg-yellow-100','text'=>'text-yellow-800','link'=>'/admin/verifikasi-berkas'],
                    ['label'=>'Lengkap Data Ortu','value'=>703,'icon'=>'👨‍👩‍👧','bg'=>'bg-purple-100','text'=>'text-purple-800','link'=>'/admin/verifikasi-berkas'],
                    ['label'=>'Upload Berkas Lengkap','value'=>623,'icon'=>'📎','bg'=>'bg-pink-100','text'=>'text-pink-800','link'=>'/admin/verifikasi-berkas'],
                    ['label'=>'Sudah Bayar Lengkap','value'=>547,'icon'=>'💰','bg'=>'bg-emerald-100','text'=>'text-emerald-800','link'=>'/admin/pembayarans'],
                    ['label'=>'Bayar Sebagian','value'=>456,'icon'=>'💳','bg'=>'bg-orange-100','text'=>'text-orange-800','link'=>'/admin/pembayarans'],
                    ['label'=>'Sudah Diterima','value'=>333,'icon'=>'🎓','bg'=>'bg-indigo-100','text'=>'text-indigo-800','link'=>'/admin/pengumumen'],
                ];
            @endphp

            @foreach ($cards as $card)
                @php
                    $percent = $total > 0 ? round(($card['value'] / $total) * 100) : 0;
                @endphp
                <a href="{{ $card['link'] ?? '#' }}" class="block">
                    <div
                        class="p-5 rounded-xl border shadow-md transition-all duration-200 hover:scale-105 hover:shadow-xl {{ $card['bg'] }} {{ $card['text'] }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold">{{ $card['label'] }}</span>
                            <span class="text-2xl">{{ $card['icon'] }}</span>
                        </div>
                        <div class="text-3xl font-bold counter" data-target="{{ $card['value'] }}">0</div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="h-2 rounded-full {{ $card['text'] }} bg-opacity-70" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Chart --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Statistik Visual Pendaftar Tahun {{ date('Y') }}
                </h2>
                <button id="toggleChart" class="px-3 py-1 rounded-lg bg-blue-500 text-white text-sm hover:bg-blue-600">
                    Ganti Chart
                </button>
            </div>
            <canvas id="pendaftarChart" height="150"></canvas>
        </div>
    </div>

    {{-- Chart & Animasi --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Counter animasi angka
        document.querySelectorAll('.counter').forEach(el => {
            const updateCounter = () => {
                const target = +el.getAttribute('data-target');
                const current = +el.innerText;
                const increment = Math.ceil(target / 30);
                if (current < target) {
                    el.innerText = current + increment;
                    setTimeout(updateCounter, 30);
                } else {
                    el.innerText = target;
                }
            };
            updateCounter();
        });

        // Chart.js
        let chartType = 'bar';
        const ctx = document.getElementById('pendaftarChart').getContext('2d');
        const data = {
            labels: ['Pendaftar','Verifikasi Email','Data Santri','Data Ortu','Berkas','Bayar Lengkap','Bayar Sebagian','Penerimaan Santri'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    1000,
                    821,
                    711,
                    703,
                    623,
                    547,
                    456,
                    333,
                ],
                backgroundColor: ['#3b82f6','#10b981','#f59e0b','#6366f1','#ec4899','#22c55e','#eab308','#8b5cf6'],
                borderRadius: 8
            }]
        };

        let chartInstance = new Chart(ctx, { type: chartType, data });

        document.getElementById('toggleChart').addEventListener('click', () => {
            chartInstance.destroy();
            chartType = chartType === 'bar' ? 'pie' : 'bar';
            chartInstance = new Chart(ctx, { type: chartType, data });
        });
    </script>
</x-filament::page>
