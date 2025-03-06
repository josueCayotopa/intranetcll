<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function editsetting()
    {
        return view('settings', ['user' => Auth::user()]);
    }

    public function updatesetting(Request $request)
    {
        $user = User::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    public function index()
    {
        $usuarios = User::all();

        return view('users.index', compact('usuarios'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }
    /**
     * Almacenar un nuevo usuario
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:int_usuario',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'nombre_completo' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048', // Permitir imágenes hasta 2MB
            'roles' => 'required|array'
        ]);

        $userData = $request->except(['foto', 'roles', 'password_confirmation']);
        $userData['password'] = Hash::make($request->password);
        $userData['foto'] = null; // Inicializar la foto

        // Guardar el usuario primero sin la imagen
        $user = User::create($userData);

        // Procesar imagen si se ha subido
        if ($request->hasFile('foto')) {
            $imagen = $request->file('foto');
            $userData['foto'] = file_get_contents($imagen->getRealPath()); // Guardar como binario
        }
        // Asignar roles
        foreach ($request->roles as $roleId) {
            $role = Role::findOrFail($roleId);
            $user->assignRole($role);
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }
    /**
     * Mostrar un usuario específico
     */
    public function show(User $user)
    {
        // Verificar si el usuario actual puede ver este perfil
        if (auth()->Auth::user()->id !== $user->id && !auth()->Auth::user()->hasRole(['admin', 'gerente_rh'])) {
            abort(403, 'No tiene permiso para ver este perfil.');
        }

        return view('users.show', compact('user'));
    }
    public function edit(User $user)
    {
        // Verificar si el usuario actual puede editar este perfil
        // if (auth()->Auth::user()->id !== $user->id && !auth()->Auth::user()->hasRole(['admin', 'gerente_rh'])) {
        //     abort(403, 'No tiene permiso para editar este perfil.');
        // }

        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Actualizar un usuario específico
     */
    public function update(Request $request, User $user)
    {
        // Verificar si el usuario actual puede actualizar este perfil
        if (auth()->Auth::use()->id !== $user->id && !auth()->Auth::user()->hasRole(['admin', 'gerente_rh'])) {
            abort(403, 'No tiene permiso para actualizar este perfil.');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('int_usuario')->ignore($user->id)],
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'nombre_completo' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ];

        // Solo los administradores y gerentes pueden cambiar roles
        if (auth()->Auth::user()->hasRole(['admin', 'gerente_rh'])) {
            $rules['roles'] = 'required|array';
        }

        // Solo validar contraseña si se está cambiando
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $request->validate($rules);

        $userData = $request->except(['imagen', 'roles', 'password', 'password_confirmation', '_token', '_method']);

        // Actualizar contraseña solo si se proporciona
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Procesar imagen si se ha subido
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $userData['imagen'] = file_get_contents($imagen->getRealPath());
        }

        $user->update($userData);

        // Actualizar roles si el usuario tiene permiso
        if (auth()->Auth::user()->hasRole(['admin', 'gerente_rh']) && $request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return redirect()->route('users.show', $user)
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar un usuario específico
     */
    public function destroy(User $user)
    {
        // No permitir que un usuario se elimine a sí mismo
        if (auth()->Auth::user()->id === $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'No puede eliminar su propio usuario.');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
