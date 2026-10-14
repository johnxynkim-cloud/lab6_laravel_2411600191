<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackFit - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .tf-gradient-bg {
            background: linear-gradient(135deg, #21b882 0%, #2fa866 50%, #00a896 100%);
        }
        .tf-card-header {
            background: linear-gradient(135deg, #2fa866 0%, #00a896 100%);
        }
    </style>
</head>
<body class="tf-gradient-bg min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Top Gradient Header -->
        <div class="tf-card-header p-8 text-center text-white relative">
            <div class="bg-white p-3 rounded-2xl inline-block shadow-md mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="TrackFit Logo" class="h-10 w-auto mx-auto">
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight">TrackFit</h1>
            <p class="text-xs text-emerald-100 mt-1">Welcome back! Ready to hit your goals?</p>
        </div>

        <!-- Form Body -->
        <div class="p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-xs rounded-lg p-3 mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Username Input -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Username</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-gray-400 text-sm">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter username"
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Password</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-gray-400 text-sm">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" placeholder="Enter password"
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-[#00a896] hover:bg-[#008a7b] text-white font-bold py-2.5 rounded-lg text-sm transition shadow-md">
                    Login
                </button>
            </form>

            <!-- Demo Credentials Footer -->
            <div class="mt-6 text-center text-xs text-gray-500 font-medium">
             <span class="font-bold text-gray-700">admin</span> / <span class="font-bold text-gray-700">password123</span>
            </div>

            <!-- Registration Link -->
            <div class="mt-4 text-center text-xs text-gray-600">
                 Don't have an account? <a href="{{ route('register') }}" class="text-[#00a896] font-semibold hover:underline">Register here</a>
        </div>
    </div>

</body>
</html>