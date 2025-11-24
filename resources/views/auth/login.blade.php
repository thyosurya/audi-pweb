@extends('layouts.guest')

@section('content')
<div class="flex w-full h-screen overflow-hidden">
    <!-- Left Side - Illustration -->
    <div class="hidden lg:flex lg:w-1/2 bg-purple-900 relative items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900 to-pink-600 opacity-90 z-10"></div>
        <!-- Abstract shapes or illustration placeholder -->
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://images.unsplash.com/photo-1545173168-9f1947eebb8f?q=80&w=2071&auto=format&fit=crop')] bg-cover bg-center"></div>
        
        <div class="relative z-20 text-white p-12 text-center">
            <h2 class="text-4xl font-bold mb-4">Professional Laundry Service</h2>
            <p class="text-lg text-purple-100">Clean, Fast, and Reliable. We take care of your clothes.</p>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-purple-900 tracking-wider mb-2">AUSAA'S <span class="text-pink-500">LAUNDRY</span></h1>
                <p class="text-gray-500">Welcome back! Please login to your account.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Role Selection -->
                <div class="flex justify-center mb-8">
                    <div class="bg-gray-100 p-1 rounded-full inline-flex">
                        <button type="button" class="role-btn px-6 py-2 rounded-full text-sm font-medium bg-white text-purple-900 shadow-sm transition-all" data-role="admin">Admin</button>
                        <button type="button" class="role-btn px-6 py-2 rounded-full text-sm font-medium text-gray-500 hover:text-purple-900 transition-all" data-role="owner">Owner</button>
                    </div>
                </div>

                <!-- Username/Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition-all" required autofocus placeholder="Enter your email">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition-all" required placeholder="Enter your password">
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-pink-500 hover:text-pink-600 font-medium">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-purple-700 to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transform transition-all hover:scale-[1.02] shadow-lg shadow-purple-200">
                    LOGIN
                </button>
            </form>

            <!-- Quick Login Info -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg text-xs text-gray-600">
                <p class="font-semibold mb-2">Test Credentials:</p>
                <p>Admin: admin@example.com / password</p>
                <p>Owner: owner@example.com / password</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Role toggle functionality
    document.querySelectorAll('.role-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active state from all buttons
            document.querySelectorAll('.role-btn').forEach(b => {
                b.classList.remove('bg-white', 'text-purple-900', 'shadow-sm');
                b.classList.add('text-gray-500');
            });
            
            // Add active state to clicked button
            this.classList.add('bg-white', 'text-purple-900', 'shadow-sm');
            this.classList.remove('text-gray-500');
            
            // Update email placeholder based on role
            const role = this.dataset.role;
            const emailInput = document.getElementById('email');
            if (role === 'admin') {
                emailInput.value = 'admin@example.com';
            } else {
                emailInput.value = 'owner@example.com';
            }
        });
    });
</script>
@endsection
