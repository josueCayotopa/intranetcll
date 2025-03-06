<!-- resources/views/archivos/show.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Archivo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Ver Archivo</h1>
        <a href="{{ route('archivos.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 mb-6">Volver</a>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-200 px-6 py-4 border-b border-gray-300">
                <h2 class="text-xl font-semibold text-gray-800">{{ $archivo->nombre }}</h2>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <span class="font-bold text-gray-700">ID:</span> 
                    <span class="text-gray-600">{{ $archivo->id }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Tipo:</span> 
                    <span class="text-gray-600">{{ $archivo->tipo_archivo }}</span>
                </div>
                <div class="mb-4">
                    <span class="font-bold text-gray-700">Tamaño:</span> 
                    <span class="text-gray-600">{{ round($archivo->tamano / 1024, 2) }} KB</span>
                </div>
                <div class="mb-4">
                    <a href="{{ route('archivos.download', $archivo->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Descargar PDF</a>
                </div>
                <div class="mb-2">
                    <span class="font-bold text-gray-700">Creado:</span> 
                    <span class="text-gray-600">{{ $archivo->created_at }}</span>
                </div>
                <div>
                    <span class="font-bold text-gray-700">Actualizado:</span> 
                    <span class="text-gray-600">{{ $archivo->updated_at }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>