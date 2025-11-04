<div 
    x-data="{ 
        showNotification: false,
        notificationMessage: '',
        showNotificationFor(message, duration = 3000) {
            this.notificationMessage = message;
            this.showNotification = true;
            setTimeout(() => this.showNotification = false, duration);
        }
    }"
    class="grid grid-cols-1 lg:grid-cols-3 gap-8"
>
    <!-- Notification -->
    <div 
        x-show="showNotification" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2"
        class="fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-lg rounded-r-lg z-50"
        role="alert"
    >
        <p class="font-medium" x-text="notificationMessage"></p>
    </div>

    <!-- Left column: selector + waiting list -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Header Section with real-time updates -->
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="flex items-center">
                    <div class="relative">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <h2 class="ml-2 text-xl font-bold text-gray-800">Antrian Aktif</h2>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-sm bg-gray-100 px-3 py-1 rounded-full" wire:poll.1s>
                    <span class="font-medium text-gray-800">{{ now()->format('H:i') }}</span>
                    <span class="text-gray-500">{{ now()->format(':s') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="p-6">
                <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Pilih Loket Pelayanan
                </label>
                
                <div class="relative">
                    <select 
                        wire:model.live="loketId" 
                        class="w-full rounded-lg bg-gray-50 px-4 py-3 text-sm border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20 transition-all duration-200 appearance-none"
                        wire:loading.class="opacity-50"
                        wire:target="loketId"
                    >
                        <option value="">-- Pilih Loket --</option>
                        @foreach($lokets as $l)
                            <option value="{{ $l->id }}">{{ $l->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                <div wire:loading wire:target="loketId" class="mt-3">
                    <div class="flex items-center space-x-2 text-blue-600">
                        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm font-medium">Memperbarui data loket...</span>
                    </div>
                </div>

            @if($loketId)
                <div class="mt-4">
                    <div class="relative overflow-hidden">
                        <div class="p-5 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl text-white">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <div class="w-12 h-12 rounded-lg bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center text-lg font-bold transform hover:scale-105 transition-all duration-200">
                                            <span class="relative z-10">PE</span>
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-lg font-bold">Petugas Loket</div>
                                        <div class="text-blue-100">
                                            {{ optional($lokets->where('id', $loketId)->first())->name ?? 'Pilih loket' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs text-blue-100 opacity-75">Status</div>
                                    <div class="flex items-center mt-1">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                        <span class="text-sm">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-blue-100 text-sm border-t border-white border-opacity-20 pt-4 mt-2">
                                <span wire:poll.3s>Waktu Aktif: {{ now()->format('H:i:s') }}</span>
                                <span class="px-2 py-1 bg-white bg-opacity-20 rounded-lg backdrop-blur-sm">
                                    {{ now()->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white bg-opacity-10 rounded-full blur-xl"></div>
                    </div>
                </div>
            @else
                <div class="mt-4 bg-gray-50 rounded-xl border border-gray-200 p-5">
                    <div class="flex items-center justify-center text-center">
                        <div>
                            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                            </div>
                            <h3 class="text-gray-700 font-medium mb-1">Belum Ada Loket Aktif</h3>
                            <p class="text-sm text-gray-500">Silakan pilih loket untuk memulai pelayanan</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden" wire:poll.5s>
            <div class="border-b border-gray-100 bg-white px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        <h4 class="text-lg font-semibold text-gray-800">Daftar Antrian Menunggu</h4>
                    </div>
                    @if(isset($waitingList) && $waitingList->count() > 0)
                        <span class="px-3 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded-full">
                            {{ $waitingList->count() }} Antrian
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                @if(!$loketId)
                    <div class="flex items-center justify-center p-6 text-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="text-gray-500">Pilih loket terlebih dahulu</div>
                        </div>
                    </div>
                @elseif(isset($waitingList) && $waitingList->count() > 0)
                    <div class="space-y-3">
                        @foreach($waitingList as $w)
                            <div class="group flex items-center justify-between border border-gray-100 rounded-xl p-4 hover:bg-blue-50 hover:border-blue-200 transition-all duration-200">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center font-bold shadow-sm">
                                        {{ substr($w->nomor, -2) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">{{ $w->nomor }}</div>
                                        <div class="text-sm text-gray-600">{{ $w->patient_name ?? 'Tanpa Nama' }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button 
                                        wire:click="callSpecific({{ $w->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="callSpecific({{ $w->id }})"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:shadow-md flex items-center group-hover:bg-blue-700"
                                    >
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                        </svg>
                                        <span wire:loading.remove wire:target="callSpecific({{ $w->id }})">Panggil</span>
                                        <span wire:loading wire:target="callSpecific({{ $w->id }})">Memanggil...</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex items-center justify-center p-6 text-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <div class="text-gray-500">Tidak ada antrian menunggu</div>
                        </div>
                    </div>
                @endif
            </div>

            <div wire:loading wire:target="waitingList" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                <div class="flex items-center space-x-2 text-blue-600">
                    <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm font-medium">Memperbarui data...</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Center spacer for balanced layout on large screens -->
    <div class="lg:col-span-1"></div>

    <!-- Right column: current called -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-100 transition-all duration-300 hover:shadow-xl text-center">
            <h4 class="text-lg font-semibold text-gray-700 mb-6 flex items-center justify-center">
                <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
                Sedang Dipanggil
            </h4>
            @if($currentCalled)
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100 mb-6">
                    <div class="text-6xl font-extrabold text-blue-600 mb-3 tracking-wider">{{ $currentCalled->nomor }}</div>
                    <div class="text-sm font-medium text-gray-600 mb-5">Loket: {{ optional($currentCalled->loket)->name ?? '-' }}</div>
                    <button wire:click="finish({{ $currentCalled->id }})" class="bg-green-600 hover:bg-green-700 text-white w-full py-3 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 shadow-md font-medium">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Selesai
                        </span>
                    </button>
                </div>
            @else
                <div class="bg-gray-50 rounded-xl border border-gray-200 p-10 mb-6">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-gray-500 font-medium">Belum ada panggilan</div>
                </div>
            @endif

            <button wire:click="callNext" class="bg-indigo-600 hover:bg-indigo-700 text-white w-full py-3 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 shadow-md font-medium">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    Panggil Berikutnya
                </span>
            </button>
        </div>
    </div>
</div>
