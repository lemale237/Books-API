<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    public function store(Request $request)
    {
        // On définit les règles de validation pour chaque champ du livre
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'published_at' => 'nullable|date',
        ];

        // On valide les données reçues dans la requête avec les règles définies
        $validatedData = $request->validate($rules);

        // On crée le livre avec les données validées
        $book = Book::create($validatedData);

        // On retourne la réponse avec le livre créé et le code de statut 201
        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        // On définit les règles de validation pour chaque champ du livre
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'published_at' => 'nullable|date',
        ];

        // On valide les données reçues dans la requête avec les règles définies
        $validatedData = $request->validate($rules);

        // On trouve le livre correspondant à l'identifiant $id
        $book = Book::findOrFail($id);

        // On met à jour le livre avec les données validées
        $book->update($validatedData);

        // On retourne la réponse avec le livre mis à jour et le code de statut 200
        return response()->json($book, 200);
    }

    public function delete(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(null, 204);
    }

}
