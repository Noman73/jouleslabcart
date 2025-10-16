<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
<div class="w-full max-w-sm p-8 bg-white rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

    <form action="{{route('admin.login')}}" method="POST" class="space-y-5">
        @csrf
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Enter your email"
            />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="••••••••"
            />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center text-sm text-gray-600">
                <input type="checkbox" class="mr-2 rounded text-blue-500 focus:ring-0">
                Remember me
            </label>
            <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full py-2 font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition duration-300"
        >
            Login
        </button>
    </form>

    <p class="mt-6 text-sm text-center text-gray-600">
        Don’t have an account?
        <a href="#" class="text-blue-600 font-semibold hover:underline">Sign up</a>
    </p>
</div>
</body>
</html>
