<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class BookController extends Controller
{

    // Récupère tous les livres de la base de données avec pagination
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $books = Book::paginate($perPage);
        return response()->json($books);
    }

    // Récupère un livre spécifique en fonction de son ID
    public function show($id)
    {
        $book = Book::find($id);

        // Si le livre n'existe pas, retourne une réponse d'erreur
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

     // Ajoute un nouveau livre à la base de données
    public function store(Request $request)
    {
        // Valide les données reçues dans la requête HTTP
        $validator = Validator::make($request->all(), [
            'isbn' => ['required', 'string', 'max:255', $this->uniqueIsbn()],
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_date' => 'nullable|date',
        ]);

         // Si la validation échoue, retourne une réponse d'erreur

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crée un nouveau livre à partir des données reçues et l'ajoute à la base de données
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    // Met à jour les données d'un livre existant en fonction de son ID
    public function update(Request $request, $id)
    {
        // Valide les données reçues dans la requête HTTP
        $validator = Validator::make($request->all(), [
            'isbn' => ['nullable', 'string', 'max:255', $this->uniqueIsbn($id)],
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_date' => 'nullable|date',
        ]);

          // Si la validation échoue, retourne une réponse d'erreur
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

         // Récupère le livre à mettre à jour en fonction de son ID
        $book = Book::findOrFail($id);
         // Récupère le livre à mettre à jour en fonction de son ID
        $book->update($request->all());
        return response()->json($book, 200);
    }

    // Supprime un livre existant en fonction de son ID
    public function delete(Request $request, $id)
    {
         // Récupère le livre à supprimer en fonction de son ID
        $book = Book::findOrFail($id);
         // Supprime le livre de la base de données
        $book->delete();
        return response()->json(null, 204);
    }
     // Fonction utilisée pour valider l'unicité de l'ISBN d'un livre
    private function uniqueIsbn($id = null)
    {// Retourne une fonction de validation personnalisée qui peut être utilisée par le validateur de Laravel
        return function ($attribute, $value, $fail) use ($id) {
            $query = Book::where('isbn', $value);

            if ($id) {
                $query->where('id', '!=', $id);
            }

            $book = $query->first();

            if ($book) {
                $fail('The ' . $attribute . ' is already in use.');
            }
        };
    }

}
