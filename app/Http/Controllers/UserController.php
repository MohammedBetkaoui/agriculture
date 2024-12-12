<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;



class UserController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.'], 403);
        }



        $admin = Auth::user();
        if (!$admin || $admin->role !== 'admin') {
            return response()->json(['error' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.'], 403);
        }

        // Récupérer tous les utilisateurs (sauf l'administrateur), produits et catégories
        $users = User::where('id', '!=', $admin->id)->get();


        return view('all_user', compact('users'));
    }

    public function destroy(User $user)
    {
        // Vérifier si l'utilisateur est administrateur
        $admin = Auth::user();
        if (!$admin || $admin->role !== 'admin') {
            return response()->json(['error' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.'], 403);
        }

        // Suppression de le user
        $user->delete();

        // Redirection avec message de succès
        return redirect()->route('all_user')->with('success', 'Utilisateur supprimée avec succès.');
    }
}
