<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->get();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'grade' => ['string', 'in:Read later,Excellent,Good,Average,Bad,Disgusting'],
        ]);

        $imgPath = null;
        if($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('users/' . Auth::id(), 'public');
        }

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $imgPath,
            'grade' => $request->grade ?? 'Read later',
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Book created!', 'book' => $book]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($book->img) {
            $book->img = asset('storage/' . $book->img);
        }
        
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'img' => ['nullable'],
            'grade' => ['string', 'in:Read later,Excellent,Good,Average,Bad,Disgusting'],
        ]);

        if($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $book->update($request->only(['title', 'description', 'img', 'grade']));

        return response()->json(['message' => 'Book updated!', 'book' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if($book->user_id !== auth()->Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted!']);
    }
}
