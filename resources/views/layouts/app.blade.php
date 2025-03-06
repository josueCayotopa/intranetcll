<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Recursos Humanos - Clínica La Luz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#b0131e', /* Rojo de la Clínica La Luz */
                        'secondary': '#F9FAFB',
                        'accent': '#6B7280',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Incluir el header -->
        @include('layouts.partials.header')

       
        <div class="flex flex-1">
            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Contenido principal -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                @yield('content')
            </main>
        </div>

        <!-- Incluir el footer -->
        @include('layouts.partials.footer')
</body>
</html>