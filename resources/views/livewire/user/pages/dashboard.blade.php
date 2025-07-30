<x-filament::page>
    {{-- Akses Hanya untuk User --}}
    @if (auth()->user()->role !== 'user')
        <script>
            window.location = "{{ url('/admin') }}";
        </script>
    @endif

    <div class="space-y-6">
        {{-- Judul Selamat Datang --}}
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">👋 Selamat Datang Kembali!</h1>
            <p class="text-gray-600 dark:text-gray-300">Berikut adalah status dan progres pendaftaranmu.</p>
        </div>

        {{-- Informasi Gelombang --}}
        @if ($gelombang)
            <div class="flex items-center gap-3 p-4 rounded-lg bg-blue-100 border border-blue-300">
                <div class="text-2xl">📆</div>
                <div>
                    <p class="font-semibold text-blue-900">
                        Gelombang {{ $gelombang->gelombang }} sedang dibuka
                    </p>
                    <p class="text-sm text-blue-700">
                        dari {{ \Carbon\Carbon::parse($gelombang->tanggal_mulai)->format('d M Y') }}
                        sampai {{ \Carbon\Carbon::parse($gelombang->tanggal_selesai)->format('d M Y') }}
                    </p>
                </div>
            </div>
        @else
            <div class="flex items-center gap-3 p-4 rounded-lg bg-red-100 border border-red-300">
                <div class="text-2xl">⛔</div>
                <div>
                    <p class="font-semibold text-red-900">
                        Pendaftaran Telah Ditutup
                    </p>
                    <p class="text-sm text-red-700">Saat ini tidak ada gelombang pendaftaran yang aktif.</p>
                </div>
            </div>
        @endif

        {{-- Pengumuman Diterima --}}
        @if ($pengumuman)
            <div class="flex items-center gap-3 p-4 rounded-lg bg-green-100 border border-green-400">
                <div class="text-2xl">🎉</div>
                <div>
                    <p class="font-bold text-green-800">Selamat! Kamu telah DITERIMA!</p>
                    <p class="text-sm text-green-700">Silakan ikuti informasi selanjutnya dari panitia.</p>
                </div>
            </div>
        @endif

        @php
            $steps = [
                ['label' => 'Mengisi Data Santri', 'done' => $user->santri !== null],
                ['label' => 'Mengisi Data Orang Tua', 'done' => $user->ortu !== null],
                ['label' => 'Mengunggah Berkas', 'done' => $user->berkas !== null],
                ['label' => 'Melakukan Pembayaran', 'done' => $user->pembayaran->contains(fn($p) => $p->status !== 'menunggu')],
            ];
            $total = count($steps);
            $completed = collect($steps)->where('done', true)->count();
            $percentage = round(($completed / $total) * 100);
        @endphp

        {{-- Progress Bar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Progres Pendaftaran: <strong>{{ $percentage }}%</strong>
            </label>
            <div class="w-full h-5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                <div class="h-full bg-green-500 text-xs text-center text-white transition-all duration-300"
                    style="width: {{ $percentage }}%">
                    {{ $percentage }}%
                </div>
            </div>
        </div>

        {{-- Checklist Langkah-langkah --}}
        <div class="grid md:grid-cols-2 gap-4">
            @foreach ($steps as $step)
                <div class="p-4 rounded-xl shadow transition transform hover:scale-[1.01]
                    {{ $step['done'] ? 'bg-green-50 border border-green-300' : 'bg-red-50 border border-red-300' }}">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-800 dark:text-white">{{ $step['label'] }}</span>
                        @if ($step['done'])
                            <span class="text-green-600 font-bold text-xl">✔</span>
                        @else
                            <span class="text-red-600 font-bold text-xl">✘</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-filament::page>
