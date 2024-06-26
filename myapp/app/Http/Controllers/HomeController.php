<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vetement;
use App\Models\Commande;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::orderByDesc('id')->count();
        $commandes = Commande::orderByDesc('id')->count();
        $vetements = Vetement::orderByDesc('id')->count();
        return view('home', [
            'users' => $users,
            'commandes' => $commandes,
            'vetements' => $vetements,
        ]);
    }
}
