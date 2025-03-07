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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10048', // Hasta 10MB
            'roles' => 'required|array'
        ]);

        $userData = $request->except(['foto', 'roles', 'password_confirmation']);
        $userData['password'] = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('fotos', 'public');
            $userData['foto'] = $path;
        }

        try {
            // Crear usuario con la foto
            $user = User::create($userData);

            // Asignar roles al usuario
            foreach ($request->roles as $roleId) {
                $role = Role::findOrFail($roleId);
                $user->assignRole($role);
            }

            return redirect()->route('users.index')
                ->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }


    /**
     * Mostrar un usuario específico
     */
    public function show(User $user)
    {
      

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
    $rules = [
        'name' => 'required|string|max:255',
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('int_usuario')->ignore($user->id)],
        'telefono' => 'required|string|max:20',
        'direccion' => 'required|string|max:255',
        'nombre_completo' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10048', // Hasta 10MB
    ];

 
    // Solo validar contraseña si se está cambiando
    if ($request->filled('password')) {
        $rules['password'] = 'string|min:8|confirmed';
    }

    $request->validate($rules);

    $userData = $request->except(['foto', 'roles', 'password', 'password_confirmation', '_token', '_method']);

    // Actualizar contraseña solo si se proporciona
    if ($request->filled('password')) {
        $userData['password'] = Hash::make($request->password);
    }

    // Procesar imagen si se ha subido
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $path = $file->store('fotos', 'public');
        $userData['foto'] = $path;
    }

    $user->update($userData);



    return redirect()->route('users.show', $user)
        ->with('success', 'Usuario actualizado exitosamente.');
}

    /**
     * Eliminar un usuario específico
     */
    public function destroy(User $user)
    {
  

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
