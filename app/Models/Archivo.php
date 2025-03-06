<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';
    
    protected $fillable = [
        'nombre',
        'contenido',
        'tipo_archivo',
        'tamano'
    ];

    // Asegurarse de que el contenido se maneje como binario
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
  
  
    // No intentar serializar el contenido binario
    protected $hidden = ['contenido'];
}
