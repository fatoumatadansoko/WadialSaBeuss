<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriePrestataireRequest;
use App\Http\Requests\UpdateCategoriePrestataireRequest;
use App\Models\CategoriePrestataire;

class CategoriePrestataireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesprestataires = CategoriePrestataire::all();
        return response()->json([
            'status' => true,
            'message' => 'Catégories récupérées avec succès',
            'data' => $categoriesprestataires
        ], 200);
    }

    // Méthode pour récupérer une catégorie spécifique
    public function show($id)
    {
        $categorieprestataire = CategoriePrestataire::find($id);
        if (!$categorieprestataire) {
            return response()->json([
                'status' => false,
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Catégorie récupérée avec succès',
            'data' => $categorieprestataire
        ], 200);
    }

    // Méthode pour créer une nouvelle catégorie
    public function store(StoreCategoriePrestataireRequest $request)
    {
        $validated = $request->validated();

        $categorieprestataire = CategoriePrestataire::create([
            'titre' => $validated['titre'],
            'description' => $validated['description']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Catégorie créée avec succès',
            'data' => $categorieprestataire
        ], 201);
    }

    // Méthode pour mettre à jour une catégorie existante
    public function update(UpdateCategoriePrestataireRequest $request, $id)
    {
        $categorieprestataire= CategoriePrestataire::find($id);
        if (!$categorieprestataire) {
            return response()->json([
                'status' => false,
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        $validated = $request->validated();
        $categorieprestataire->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Catégorie mise à jour avec succès',
            'data' => $categorieprestataire
        ], 200);
    }

    // Méthode pour supprimer une catégorie
    public function destroy($id)
    {
        $categorieprestataire = CategoriePrestataire::find($id);
        if (!$categorieprestataire) {
            return response()->json([
                'status' => false,
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        $categorieprestataire->delete();

        return response()->json([
            'status' => true,
            'message' => 'Catégorie supprimée avec succès'
        ], 200);
    }
}