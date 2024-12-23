<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8f9fc] text-white">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <!-- Header Section -->
        <header class="w-full p-6 bg-[#4e73df] shadow-md">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">
                    ID MAKER
                </h1>
                @if (Route::has('login'))
                    <div class="text-right">
                        @auth
                            <a href="{{ url('/home') }}"
                               class="text-sm font-semibold text-white hover:text-gray-200 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                Home
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-sm font-semibold text-white hover:text-gray-200 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="ml-4 text-sm font-semibold text-white hover:text-gray-200 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="flex-grow flex flex-col items-center justify-center text-center">
            <h2 class="text-4xl font-bold mb-6">
                <span class="text-black">  Welcome to <span class="text-black">ID MAKER</span>
            </h2>
            <p class="text-lg text-black max-w-lg mb-8">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem ducimus, dolor natus ipsum asperiores optio a dolore fugiat neque nulla.
            </p>
            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-[#4e73df] text-white rounded-lg shadow-md hover:bg-[#4e73df] focus:outline focus:outline-2 focus:rounded-sm focus:outline-[#4e73df]">
                Get Started
            </a>
        </main>


</body>
</html>
