<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <div class="flex items-center">
            <img src="{{ asset('/images/clinica_la_luz_logo.png') }}" alt="Logo Clínica La Luz" class="h-10">
        </div>
        <div class="flex items-center space-x-4 relative">
            <span class="text-gray-700">{{ auth()->user()->name ?? 'Usuario' }}</span>
            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white cursor-pointer" id="userMenuButton">
                <?php 
                    $initials = '';
                    if (auth()->check()) {
                        $name_parts = explode(' ', trim(auth()->user()->name));
                        $initials = isset($name_parts[0][0]) ? strtoupper($name_parts[0][0]) : '';
                        $initials .= isset($name_parts[1][0]) ? strtoupper($name_parts[1][0]) : '';
                    } else {
                        $initials = 'U';
                    }
                    echo $initials;
                ?>
            </div>

            <!-- Menú desplegable -->
            <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg py-2">
                <a href="{{ route('settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ajustes</a>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById('userMenuButton').addEventListener('click', function () {
        document.getElementById('userMenu').classList.toggle('hidden');
    });
</script>
