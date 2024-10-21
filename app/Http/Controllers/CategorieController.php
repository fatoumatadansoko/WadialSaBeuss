<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Méthode pour récupérer toutes les catégories
    public function index()
    {
        $categories = Categorie::all();
        return response()->json([
            'status' => true,
            'message' => 'Catégories récupérées avec succès',
            'data' => $categories
        ], 200);
    }

    // Méthode pour récupérer une catégorie spécifique
    public function show($id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json([
                'status' => false,
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Catégorie récupérée avec succès',
            'data' => $categorie
        ], 200);
    }

    // Méthode pour créer une nouvelle catégorie
    public function store(StoreCategorieRequest $request)
    {
        $validated = $request->validated();

        $categorie = Categorie::create([
            'titre' => $validated['titre'],
            'description' => $validated['description']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Catégorie créée avec succès',
            'data' => $categorie
        ], 201);
    }

    // Méthode pour mettre à jour une catégorie existante
    public function update(UpdateCategorieRequest $request, $id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json([
                'status' => false,
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        $validated = $request->validated();
        $categorie->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Catégorie mise à jour avec succès',
            'data' => $categorie
        ], 200);
    }

    // Méthode pour supprimer une catégorie
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json([
                'status' => false,
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        $categorie->delete();

        return response()->json([
            'status' => true,
            'message' => 'Catégorie supprimée avec succès'
        ], 200);
    }
}
