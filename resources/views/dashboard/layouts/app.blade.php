<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Martian+Mono:wght@400;500;600&display=swap" rel="stylesheet">
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
<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Offcanvas Backdrop -->
        <div class="offcanvas-backdrop" id="offcanvasBackdrop" onclick="toggleOffcanvas()"></div>

        <!-- Sidebar/Offcanvas -->
        <div class="offcanvas bg-white border-r border-gray-200" id="sidebar">
            <div class="p-4 flex justify-between items-center border-b border-gray-200">
                <h1 class="text-xl font-bold text-primary">Admin Panel</h1>
                <button class="md:hidden text-gray-500 hover:text-gray-700" onclick="toggleOffcanvas()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="mt-4">
                <ul>
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-dashboard mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.collections.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-book-2 mr-2"></i>
                            Collections
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.entries.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-file-text mr-2"></i>
                            Entries
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.field-groups.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-layout-grid mr-2"></i>
                            Field Groups
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.fields.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-forms mr-2"></i>
                            Fields
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.sections.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-layout mr-2"></i>
                            Sections
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.media.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-photo mr-2"></i>
                            Media
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.users.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-users mr-2"></i>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.revisions.index') }}" class="block py-3 px-4 text-primary hover:bg-gray-100 transition-colors duration-200">
                            <i class="ti ti-history mr-2"></i>
                            Revisions
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-4 border-b border-gray-200 md:hidden">
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
