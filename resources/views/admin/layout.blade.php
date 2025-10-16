<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                        dark: '#1f2937',
                        light: '#f9fafb'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-10 fixed h-full" id="sidebar">
        <div class="p-4">
            <h1 class="text-2xl font-bold text-primary">AdminPanel</h1>
        </div>
        <nav class="mt-6">
            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Main</div>
            <a href="#" class="flex items-center px-4 py-3 text-gray-700 bg-blue-50 border-r-4 border-primary">
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                <i class="fas fa-users mr-3"></i>
                <span>Users</span>
            </a>
            <a href="{{route("product.index")}}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                <i class="fas fa-shopping-cart mr-3"></i>
                <span>Products</span>
            </a>
            <a href="{{route("coupons.index")}}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100">
                <i class="fas fa-chart-bar mr-3"></i>
                <span>Coupon</span>
            </a>


        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col md:ml-64">
        <!-- Header -->
        <header class="bg-white shadow-sm z-10">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <button id="menu-toggle" class="text-gray-500 focus:outline-none md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="relative mx-4 lg:mx-0">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fas fa-search text-gray-500"></i>
                            </span>
                        <input class="w-32 pl-10 pr-4 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary lg:w-full" type="text" placeholder="Search">
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button class="flex items-center text-gray-500 focus:outline-none">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </button>
                    </div>
                    <div class="relative ml-4">
                        <button class="flex items-center text-gray-500 focus:outline-none" id="user-menu">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User Avatar">
                            <span class="ml-2 hidden md:block">John Doe</span>
                            <i class="fas fa-chevron-down ml-1 hidden md:block"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden" id="user-dropdown">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="{{route("admin.logout")}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6">
{{--            <div class="mb-6">--}}
{{--                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>--}}
{{--                <p class="text-gray-600">Welcome back, John! Here's what's happening today.</p>--}}
{{--            </div>--}}

            @yield('main_content')
        </main>
    </div>
</div>

<script>
    // Toggle sidebar on mobile
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });

    // Toggle user dropdown
    document.getElementById('user-menu').addEventListener('click', function() {
        const dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userMenu = document.getElementById('user-menu');
        const dropdown = document.getElementById('user-dropdown');

        if (!userMenu.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Simulate loading data
    document.addEventListener('DOMContentLoaded', function() {
        // This is where you would fetch data from an API
        console.log('Admin panel loaded');
    });
</script>
</body>
</html>
