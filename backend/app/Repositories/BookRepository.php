<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookRepository
{
    public function getUserBooks()
    {
        return Book::where('user_id', Auth::id())->get();
    }

    public function createBook(array $data): Book
    {
        return Book::create($data);
    }

    public function updateBook(Book $book, array $data): bool
    {
        return $book->update($data);
    }

    public function deleteBook(Book $book): bool
    {
        return $book->delete();
    }
}
