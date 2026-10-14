<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TrackFit') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-[#f4f6f8] min-h-screen">

  <!-- Top Header Bar -->
    <header class="text-white p-4 shadow-md flex items-center justify-between" style="background: linear-gradient(90deg, #00A8A8 0%, #52B75A 100%);">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="TrackFit Logo" class="h-10 w-auto bg-white p-1 rounded">
            <span class="text-2xl font-bold tracking-wide">TRACKFIT INVENTORY</span>
        </div>
        
        @auth
        <!-- Right side user info & logout button -->
        <div class="flex items-center space-x-4">
            <span class="text-sm font-medium">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
            
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-white/20 hover:bg-white/30 text-white px-3.5 py-1.5 rounded-lg text-sm font-semibold transition-all border border-white/30 shadow-sm">
                    Logout
                </button>
            </form>
        </div>
        @endauth
    </header>

    <!-- Main Container with Sidebar + Content -->
    <div class="flex min-h-[calc(100vh-72px)]">

        <!-- Left Sidebar Navigation -->
        <aside class="w-64 bg-white shadow-lg border-r border-gray-200 p-6">
            <nav class="space-y-3">
                <a href="{{ route('dashboard') }}" 
                   class="block px-4 py-3 rounded-lg font-semibold transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#00A8A8] text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                   Dashboard
                </a>

                <a href="{{ route('products.index') }}" 
                   class="block px-4 py-3 rounded-lg font-semibold transition-colors {{ request()->routeIs('products.*') ? 'bg-[#00a88f] text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                   Products
                </a>

                <a href="{{ route('transactions.index') }}" 
                   class="block px-4 py-3 rounded-lg font-semibold transition-colors {{ request()->routeIs('transactions.*') ? 'bg-[#00a88f] text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                   Transactions
                </a>
            </nav>
        </aside>

        <!-- Right Main Content Area -->
        <main class="flex-1 p-8">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

    </div>

</body>
</html>