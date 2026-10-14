@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100 mt-10">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create an Account</h1>
        <p class="text-sm text-gray-500 mt-1">Register to access TrackFit Inventory</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none">
            @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none">
            @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message ?></span> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none">
            @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-[#00a88f] focus:border-[#00a88f] outline-none">
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full bg-[#00a88f] hover:bg-[#008f7a] text-white font-semibold py-2.5 rounded-lg shadow-sm transition-colors mt-2">
            Register
        </button>
    </form>

    <div class="text-center mt-4 text-sm text-gray-600">
        Already have an account? 
        <a href="{{ route('login') }}" class="text-[#00a88f] font-semibold hover:underline">Login here</a>
    </div>
</div>
@endsection