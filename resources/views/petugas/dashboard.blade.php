@extends('layouts.dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-emerald-700 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            Manajemen Antrian
        </h1>
        <p class="mt-2 text-sm text-gray-600 ml-16">Kelola dan panggil antrian pasien secara efisien</p>
    </div>

    <livewire:petugas-queue />
@endsection
