<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchivoController extends Controller
{
    //
    public function index()
    {
        $archivos = Archivo::all();
        return view('archivos.index', compact('archivos'));
    }

    public function create()
    {
        return view('archivos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'archivo_pdf' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);
    
        if ($request->hasFile('archivo_pdf')) {
            try {
                $file = $request->file('archivo_pdf');
                
                // Crear un nuevo registro de archivo
                $archivo = new Archivo();
                $archivo->nombre = $request->nombre;
                $archivo->tipo_archivo = $file->getClientMimeType();
                $archivo->tamano = $file->getSize();
                
                // Guardar primero sin el contenido
                $archivo->save();
                
                // Ahora actualizar el contenido usando una consulta directa
                $contenido = base64_encode(file_get_contents($file->getRealPath()));
                
                // Usar una consulta SQL directa para actualizar solo el campo contenido
                DB::statement("
                    UPDATE archivos 
                    SET contenido = CONVERT(VARBINARY(MAX), ?)
                    WHERE id = ?
                ", [$contenido, $archivo->id]);
    
                return redirect()->route('archivos.index')
                    ->with('success', 'Archivo PDF subido correctamente.');
            } catch (\Exception $e) {
                return back()->with('error', 'Error al subir el archivo: ' . $e->getMessage());
            }
        }
        
        return back()->with('error', 'No se pudo subir el archivo.');
    }
    public function download(Archivo $archivo)
{
    // Obtener el contenido directamente de la base de datos
    $contenidoBase64 = DB::table('archivos')
        ->where('id', $archivo->id)
        ->value('contenido');
    
    // Decodificar el contenido
    $contenido = base64_decode($contenidoBase64);
    
    $headers = [
        'Content-Type' => $archivo->tipo_archivo,
        'Content-Disposition' => 'attachment; filename="' . $archivo->nombre . '.pdf"',
    ];

    return response($contenido, 200, $headers);
}
    public function show(Archivo $archivo)
    {
        return view('archivos.show', compact('archivo'));
    }

    public function edit(Archivo $archivo)
    {
        return view('archivos.edit', compact('archivo'));
    }

    public function update(Request $request, Archivo $archivo)
    {
        $request->validate([
            'nombre' => 'required',
            'archivo_pdf' => 'nullable|mimes:pdf|max:10240', // max 10MB
        ]);

        $archivo->nombre = $request->nombre;
        
        if ($request->hasFile('archivo_pdf')) {
            $file = $request->file('archivo_pdf');
            $archivo->contenido = file_get_contents($file->getRealPath());
            $archivo->tipo_archivo = $file->getClientMimeType();
            $archivo->tamano = $file->getSize();
        }
        
        $archivo->save();
        
        return redirect()->route('archivos.index')
            ->with('success', 'Archivo actualizado correctamente');
    }

    public function destroy(Archivo $archivo)
    {
        $archivo->delete();
        return redirect()->route('archivos.index')
            ->with('success', 'Archivo eliminado correctamente');
    }
    
   

}
