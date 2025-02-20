<?php 
namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller {
    public function index() {
        $annonces = Annonce::paginate(10);
        return view('annonce.index', compact('annonces'));
    }

    public function create() {
        return view('annonce.create');
    }

    public function store(Request $request) {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required|exists:users,id',
            'categorie_id' => 'required|exists:categories,id',
            'status' => 'required|in:actif,brouillon,archivé',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('annonces', 'public');
        }

        Annonce::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'image' => $imagePath,
            'user_id' => $request->user_id,
            'categorie_id' => $request->categorie_id,
            'status' => $request->status,
        ]);

        return redirect()->route('annonce.index')->with('status', 'Annonce créée avec succès');
    }

    public function show(Annonce $annonce) {
        return view('annonce.show', compact('annonce'));
    }

    public function edit(Annonce $annonce) {
        return view('annonce.edit', compact('annonce'));
    }

    public function update(Request $request, Annonce $annonce) {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required|exists:users,id',
            'categorie_id' => 'required|exists:categories,id',
            'status' => 'required|in:actif,brouillon,archivé',
        ]);

        $imagePath = $annonce->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('annonces', 'public');
        }

        $annonce->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'image' => $imagePath,
            'user_id' => $request->user_id,
            'categorie_id' => $request->categorie_id,
            'status' => $request->status,
        ]);

        return redirect()->route('annonce.index')->with('status', 'Annonce mise à jour avec succès');
    }

    public function destroy(Annonce $annonce) {
        $annonce->delete();
        return redirect()->route('annonce.index')->with('status', 'Annonce supprimée avec succès');
    }
}
