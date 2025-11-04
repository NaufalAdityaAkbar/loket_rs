<div wire:poll.2s class="container">
    <!-- Grouped Loket Cards -->
    @foreach($groupedLokets as $type => $lokets)
    <div class="mb-6 p-4">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                @if(strtolower($type) === 'umum')
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                @elseif(strtolower($type) === 'spesialis')
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                @else
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                @endif
            </div>
            <h2 class="text-xl font-bold text-gray-900">{{ ucwords($type) }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($lokets as $loket)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-3">
                    <h3 class="text-base font-bold text-white">{{ $loket->name }}</h3>
                    <p class="text-xs text-blue-100">{{ $loket->description }}</p>
                </div>

                @php
                    $current = $loket->antrians->where('status', App\Models\Antrian::STATUS_CALLED)->first();
                    $waiting = $loket->antrians->where('status', App\Models\Antrian::STATUS_WAITING)->take(3);
                @endphp

                <div class="p-4">
                    <!-- Current Number -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-3 text-center mb-3">
                        <p class="text-sm font-medium text-gray-600 mb-1">SEDANG DILAYANI</p>
                        <div class="text-4xl font-bold text-blue-600 tracking-wider">
                            {{ $current ? $current->nomor : '-' }}
                        </div>
                    </div>

                    <!-- Waiting Numbers -->
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-gray-900">ANTRIAN BERIKUTNYA</p>
                        <div class="space-y-2">
                            @forelse($waiting as $antrian)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-2 text-center">
                                <span class="text-lg font-semibold text-gray-900">{{ $antrian->nomor }}</span>
                            </div>
                            @empty
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-3 text-center">
                                <div class="w-8 h-8 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500">Tidak ada antrian</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
