<div wire:poll.2s>
    <div class="container p-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Section: Loket Selection -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h3 class="text-xl font-bold text-white">Layanan Tersedia</h3>
                        <p class="text-blue-100 text-sm">Pilih jenis layanan sesuai kebutuhan Anda</p>
                    </div>

                    <div class="p-6">
                        <!-- Loket Type Groups -->
                        <div class="space-y-8">
                            @foreach($lokets as $type => $typeLokets)
                                <div class="relative">
                                    <div class="flex items-center gap-3 mb-4">
                                        <!-- Icon for each type -->
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            @if(strtolower($type) === 'umum')
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            @elseif(strtolower($type) === 'spesialis')
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            @endif
                                        </div>
                                        <h4 class="text-lg font-semibold text-gray-900">{{ ucwords($type) }}</h4>
                                    </div>

                                    <div class="grid gap-4">
                                        @foreach($typeLokets as $loket)
                                            <button 
                                                wire:click="generateWithLoket({{ $loket['id'] }})"
                                                class="group relative overflow-hidden rounded-xl border border-gray-200 bg-white p-5 hover:border-blue-400 hover:shadow-md transition-all duration-300">
                                                <div class="flex items-start gap-4">
                                                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-600 group-hover:from-blue-200 group-hover:to-blue-300 transition-all duration-300">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h5 class="text-base font-semibold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">
                                                            {{ $loket['name'] }}
                                                        </h5>
                                                        @if(!empty($loket['description']))
                                                            <p class="text-sm text-gray-500">{{ $loket['description'] }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section: Queue Number -->
            <div class="lg:col-span-4">
                <div class="sticky top-6">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                            <h3 class="text-xl font-bold text-white">Nomor Antrian Anda</h3>
                            <p class="text-blue-100 text-sm">Nomor antrian akan muncul di sini</p>
                        </div>

                        <div class="p-6">
                            @if(!empty($success) && !empty($nomor))
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 text-center">
                                    <div class="text-6xl font-bold text-blue-600 mb-4 tracking-wider">{{ $nomor }}</div>
                                    @php
                                        $selectedLoket = $this->getSelectedLoket();
                                    @endphp
                                    @if($selectedLoket)
                                        <div class="space-y-2 mb-6">
                                            <div class="bg-white rounded-lg py-2 px-4 inline-block">
                                                <span class="text-gray-600">Tipe:</span>
                                                <span class="font-semibold text-gray-900 ml-1">{{ ucwords($selectedLoket->type) }}</span>
                                            </div>
                                            <div class="bg-white rounded-lg py-2 px-4 inline-block">
                                                <span class="text-gray-600">Loket:</span>
                                                <span class="font-semibold text-gray-900 ml-1">{{ $selectedLoket->name }}</span>
                                            </div>
                                        </div>
                                        <button
                                            onclick="window.print()"
                                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg py-3 px-4 font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Cetak Nomor Antrian
                                        </button>
                                    @endif
                                </div>
                            @else
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-8 text-center">
                                    <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                    <div class="text-2xl font-bold text-gray-400 mb-2">Belum Ada Nomor</div>
                                    <p class="text-gray-500">Silakan pilih layanan di samping untuk mendapatkan nomor antrian</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
