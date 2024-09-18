<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return response()->json([
            'status' => true,
            'message' => 'Images récupérées avec succès',
            'data' => $images
        ], 200);
    }
    
    // Créer une image
    public function store(Request $request)
    {
        $request->validate([
             'nom' => 'required|string|max:255',
             'prestataire_id' => 'required|exists:prestataires,id',
        ]);

        $image = Image::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Image créée avec succès',
            'data' => $image
        ], 201);
    }

    // Récupérer une image spécifique
    public function show($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json([
                'status' => false,
                'message' => 'Image non trouvée',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Image récupérée avec succès',
            'data' => $image
        ], 200);
    }
    
    // Mettre à jour une image
    public function update(Request $request, $id)
    {
        $image = Image::find($id);
    
        if (!$image) {
            return response()->json([
                'status' => false,
                'message' => 'Image non trouvée',
            ], 404);
        }
    
        $request->validate([
            'nom' => 'string|max:255',
            'prestataire_id' => 'exists:prestataires,id',
        ]);
    
    
        $image->update($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Image mise à jour avec succès',
            'data' => $image
        ], 200);
    }
    
    // Supprimer une image
    public function destroy($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json([
                'status' => false,
                'message' => 'Image non trouvée',
            ], 404);
        }

        $image->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image supprimée avec succès',
        ], 200);
    }
}
