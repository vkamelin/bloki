<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Martian Mono', 'monospace'],
                    },
                    colors: {
                        primary: '#1f2937',
                        accent: '#3b82f6',
                        text: '#f3f4f6',
                    },
                },
                darkMode: 'media',
            },
        }
    </script>
    <style>
        .offcanvas-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        .offcanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 16rem;
            height: 100%;
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            z-index: 1050;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .offcanvas.show {
            transform: translateX(0);
        }
        @media (min-width: 768px) {
            .offcanvas {
                transform: translateX(0);
                position: static;
                width: 16rem;
                height: auto;
                box-shadow: none;
            }
            .offcanvas-backdrop {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Offcanvas Backdrop -->
        <div class="offcanvas-backdrop" id="offcanvasBackdrop" onclick="toggleOffcanvas()"></div>

        <!-- Sidebar/Offcanvas -->
        <div class="offcanvas" id="sidebar">
            <div class="p-4 flex justify-between items-center border-b">
                <h1 class="text-xl font-semibold text-primary">Admin Panel</h1>
                <button class="md:hidden text-gray-500 hover:text-gray-700" onclick="toggleOffcanvas()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="mt-4">
                <ul>
                    <li>
                        <a href="{{ route('dashboard.collections.index') }}" class="block py-2 px-4 text-primary hover:bg-gray-100">Collections</a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.entries.index') }}" class="block py-2 px-4 text-primary hover:bg-gray-100">Entries</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-4 border-b md:hidden">
                <button class="text-gray-500 hover:text-gray-700" onclick="toggleOffcanvas()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleOffcanvas() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('offcanvasBackdrop');

            sidebar.classList.toggle('show');
            backdrop.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
        }
    </script>
</body>
</html>
