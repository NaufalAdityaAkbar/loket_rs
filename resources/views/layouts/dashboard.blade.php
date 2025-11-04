<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Antrian') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
    /* Admin theme overrides */
    .sidebar-link.active {
        background-color: rgba(255, 255, 255, 0.1);
        border-left: 4px solid #ffffff;
    }

    .admin-gradient {
        background: linear-gradient(135deg, #1e4b9c 0%, #2563eb 100%);
    }

    /* Ensure gradient backgrounds work */
    .bg-gradient-to-br {
        background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
    }
    
    /* Stats card colors fallback */
    .from-blue-500 { --tw-gradient-from: #3b82f6; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(59, 130, 246, 0)); }
    .to-blue-600 { --tw-gradient-to: #2563eb; }
    .from-green-500 { --tw-gradient-from: #22c55e; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(34, 197, 94, 0)); }
    .to-emerald-600 { --tw-gradient-to: #059669; }
    .from-purple-500 { --tw-gradient-from: #a855f7; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(168, 85, 247, 0)); }
    .to-purple-600 { --tw-gradient-to: #9333ea; }
    .from-orange-500 { --tw-gradient-from: #f97316; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(249, 115, 22, 0)); }
    .to-orange-600 { --tw-gradient-to: #ea580c; }
    </style>
</head>

<body class="min-h-screen bg-gray-50 font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 admin-gradient text-white min-h-screen shadow-xl fixed left-0 top-0 bottom-0 overflow-y-auto z-40">
            <div class="px-6 py-5 flex items-center gap-3 border-b border-white/10 bg-black/10">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center font-bold text-blue-700">RS
                </div>
                <div>
                    <div class="text-sm font-semibold">Rumah Sakit</div>
                    <div class="text-xs text-blue-100">Area Petugas</div>
                </div>
            </div>

            <nav class="px-3 py-6">
                <div class="text-xs font-semibold text-blue-200 uppercase px-3 mb-4">Menu Utama</div>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('petugas.dashboard') }}"
                            class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M10 2a2 2 0 00-2 2v2H6a2 2 0 00-2 2v4h12V8a2 2 0 00-2-2h-2V4a2 2 0 00-2-2z" />
                            </svg>
                            <span class="text-sm font-medium">Manajemen Antrian</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('petugas.loket') }}"
                            class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('petugas.loket') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M4 3h12v2H4V3z" />
                            </svg>
                            <span class="text-sm font-medium">Data Master Loket</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile and Logout -->
            <div class="mt-auto">
                <div class="px-3">
                    <div class="p-4 rounded-lg bg-white/10 backdrop-blur-sm">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium">{{ Auth::user()->name ?? 'User' }}</div>
                                <div class="text-xs text-blue-200">{{ Auth::user()->email ?? '' }}</div>
                            </div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-blue-700 bg-red-200 hover:bg-blue-50 rounded-lg transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 text-xs text-blue-200 bg-black/20">
                &copy; {{ date('Y') }} Sistem Antrian Rumah Sakit
            </div>
        </aside>

        <!-- Content -->
        <main class="flex-1 bg-gray-50 ml-64">
            <div class="py-8 px-6 lg:px-10">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
</body>

</html>