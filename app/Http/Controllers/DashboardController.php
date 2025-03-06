<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener usuarios para mostrar en el dashboard
        $usuarios = User::latest()->take(5)->get();
        $totalUsuarios = User::count();
        
        return view('dashboard.index', compact('usuarios', 'totalUsuarios'));
    }
}
