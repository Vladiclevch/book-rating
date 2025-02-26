<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookService
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function validateRequest(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'grade' => ['string', 'in:Read later,Excellent,Good,Average,Bad,Disgusting'],
        ]);
    }

    public function handleImageUpload(Request $request, ?Book $book = null): ?string
    {
        if(!$request->hasFile('img')) {
            return $book?->img;
        }

        if($book?->img) {
            Storage::disk('public')->delete($book->img);
        }

        return $request->file('img')->store('users/' . Auth::id(), 'public');
    }

    public function autorizeUser(Book $book): void
    {
        if($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
