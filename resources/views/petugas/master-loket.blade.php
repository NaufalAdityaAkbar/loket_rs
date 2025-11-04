@extends('layouts.dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            Master Data Loket
        </h1>
        <p class="mt-2 text-sm text-gray-600 ml-16">Kelola semua data loket rumah sakit Anda dalam satu tempat</p>
    </div>

    <livewire:master-loket />
@endsection
