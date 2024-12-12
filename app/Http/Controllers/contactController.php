<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class ContactController extends Controller
{


    public function index(){

          $user = Auth::user();
          if($user && $user->role =='admin'){
            $contacts= Contact::all();

            return view('all_contact' ,compact('contacts'));
          }else{
            return response()->json(['error' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.'], 403);

          }
       
    }




    public function sendMessage(Request $request)
    {

        $user = Auth::user();
           if($user){
        // Validez les données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
    
        // Créez un nouveau message de contact avec les données validées
        $contact = new Contact([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);
    
        // Enregistrez le message dans la base de données
        $contact->save();
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Message envoyé avec succès !');
    }else{
        return redirect()->back()->with('error', 'Vous devez d\'abord connecté ou inscrire.');

    }
    }
    public function destroy($id)
    {
        // Trouver le contact avec l'ID donné
        $contact = Contact::findOrFail($id);

        // Supprimer le contact
        $contact->delete();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Contact supprimé avec succès !');
    }
}
