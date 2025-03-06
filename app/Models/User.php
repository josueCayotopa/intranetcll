<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'int_usuario';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'direccion',
        'nombre_completo',
        'foto'
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'foto'
    ];

    /**
     * Los atributos que deben convertirse.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Los roles que pertenecen al usuario.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('nombre', $role);
        }
    
        if ($role instanceof \Illuminate\Database\Eloquent\Collection) {
            return $role->intersect($this->roles)->isNotEmpty();
        }
    
        return false;
    }

    /**
     * Asigna un rol al usuario.
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('nombre', $role)->firstOrFail();
        }
        
        $this->roles()->syncWithoutDetaching($role);
        
        return $this;
    }

    
}