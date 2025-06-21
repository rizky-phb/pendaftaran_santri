<x-filament::page>
    @if (auth()->user()->role !== 'user')
        <script>
            window.location = "{{ url('/admin') }}";
        </script>
    @endif
    <h1 class="text-2xl font-bold">Selamat Datang, Berikut status dan progres pendaftaranmu.</h1>


    {{-- Gelombang --}}
    @if ($gelombang)
        <div class="my-4 p-4 bg-blue-100 border border-blue-400 rounded">
            <strong>Gelombang {{ $gelombang->gelombang }}</strong> aktif dari
            {{ \Carbon\Carbon::parse($gelombang->tanggal_mulai)->format('d M Y') }}
            sampai {{ \Carbon\Carbon::parse($gelombang->tanggal_selesai)->format('d M Y') }}.
        </div>
    @else
        <div class="my-4 p-4 bg-red-100 border border-red-400 rounded">
            <strong>Pendaftaran telah ditutup.</strong> Tidak ada gelombang aktif saat ini.
        </div>
    @endif

    {{-- Status diterima --}}
    @if ($pengumuman)
        <div class="mb-4 p-4 bg-green-100 border border-green-400 rounded">
            <strong>Selamat!</strong> Anda telah <span class="text-green-700 text-primary font-bold">DITERIMA</span> dalam pendaftaran.
        </div>
    @endif

    @php
        $steps = [
            ['label' => 'Mengisi Data Santri', 'done' => $user->santri !== null],
            ['label' => 'Mengisi Data Orang Tua', 'done' => $user->ortu !== null],
            ['label' => 'Mengunggah Berkas', 'done' => $user->berkas !== null],
            ['label' => 'Melakukan Pembayaran', 'done' => $user->pembayaran !== null],
        ];
        $total = count($steps);
        $completed = collect($steps)->where('done', true)->count();
        $percentage = round(($completed / $total) * 100);
    @endphp

    {{-- Progres Bar --}}
    <div class="mb-4">
        <label class="block font-semibold mb-1">Progres Pendaftaran: {{ $percentage }}%</label>
        <div class="w-full bg-gray-300 rounded-full h-4">
            <div class="bg-green-500 h-4 rounded-full" style="width: {{ $percentage }}%"></div>
        </div>
    </div>

    {{-- Checklist --}}
    <div class="grid md:grid-cols-2 gap-4">
        @foreach ($steps as $step)
            <div class="p-4 border rounded-lg shadow {{ $step['done'] ? 'bg-green-100 border-green-400' : 'bg-red-100 border-red-400' }}">
                <div class="flex items-center justify-between">
                    <span>{{ $step['label'] }}</span>
                    @if ($step['done'])
                        <span class="text-green-600 font-bold">✔</span>
                    @else
                        <span class="text-red-600 font-bold">✘</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-filament::page>
