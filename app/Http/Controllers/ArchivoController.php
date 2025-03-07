<?php

namespace App\Filament\Resources\ArchivoResource\Pages;

use App\Filament\Resources\ArchivoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CreateArchivo extends CreateRecord
{
    protected static string $resource = ArchivoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Eliminamos el campo archivo_pdf para que no intente guardarlo en la base de datos
        if (isset($data['archivo_pdf'])) {
            unset($data['archivo_pdf']);
        }
        
        return $data;
    }

    protected function afterCreate(): void
    {
        // Obtenemos el ID del registro recién creado
        $record = $this->record;
        
        try {
            // Obtenemos el archivo subido
            $archivoPath = $this->data['archivo_pdf'] ?? null;
        
            // Depuración para ver qué tipo de dato es $archivoPath
            Log::info('Tipo de archivoPath: ' . gettype($archivoPath));
            Log::info('Valor de archivoPath: ', is_array($archivoPath) ? $archivoPath : [$archivoPath]);
        
            if ($archivoPath) {
                // Si es un array, tomamos el primer elemento
                if (is_array($archivoPath)) {
                    $archivoPath = reset($archivoPath); // Usa reset() en lugar de [0] para mayor seguridad
                }
            
                if (!empty($archivoPath) && is_string($archivoPath)) {
                    // Construimos la ruta completa del archivo
                    $filePath = Storage::disk('local')->path('tmp/' . $archivoPath);
                
                    if (file_exists($filePath)) {
                        // Leemos el contenido del archivo y lo codificamos en base64
                        $contenido = base64_encode(file_get_contents($filePath));
                    
                        // Actualizamos directamente con una consulta SQL que usa CONVERT
                        DB::statement("
                            UPDATE archivos 
                            SET contenido = CONVERT(VARBINARY(MAX), ?)
                            WHERE id = ?
                        ", [$contenido, $record->id]);
                    
                        // Limpiamos el archivo temporal
                        Storage::disk('local')->delete('tmp/' . $archivoPath);
                    
                        Log::info('Archivo guardado correctamente con ID: ' . $record->id);
                    } else {
                        Log::error('El archivo no existe en la ruta: ' . $filePath);
                    }
                } else {
                    Log::error('La ruta del archivo no es válida');
                }
            } else {
                Log::info('No se proporcionó ningún archivo');
            }
        } catch (\Exception $e) {
            Log::error('Error en afterCreate: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}

