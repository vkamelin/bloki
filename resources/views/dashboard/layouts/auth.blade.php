<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Login</title>
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
</head>
<body class="bg-gray-100 font-sans h-screen flex items-center justify-center">
    <main class="w-full max-w-md p-6 bg-white shadow-md rounded">
        @yield('content')
    </main>
</body>
</html>