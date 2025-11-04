@extends('layouts.dashboard')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <h2 class="text-2xl font-semibold text-gray-800">Master Data Loket</h2>
        </div>
        <div class="text-sm text-gray-500">Kelola data loket</div>
    </div>

    <livewire:master-loket />
@endsection
