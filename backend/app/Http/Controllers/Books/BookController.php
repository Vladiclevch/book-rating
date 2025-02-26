<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    private BookService $bookService;
    private BookRepository $bookRepository;

    public function __construct(BookService $bookService, BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->bookService = $bookService;
    }

    public function index()
    {
        return response()->json($this->bookRepository->getUserBooks());
    }

    public function store(Request $request)
    {
        $validatedData = $this->bookService->validateRequest($request);
        $validatedData['img'] = $this->bookService->handleImageUpload($request);
        $validatedData['user_id'] = auth()->id();
        $validatedData['grade'] = $validatedData['grade'] ?? 'Read later';

        $book = $this->bookRepository->createBook($validatedData);

        return response()->json(['message' => 'Book created!', 'book' => $book]);
    }

    public function show(Book $book)
    {
        $this->bookService->autorizeUser($book);

        if ($book->img) {
            $book->img = asset('storage/' . $book->img);
        }

        return response()->json($book);
    }

    public function update(Request $request, Book $book)
    {
        $this->bookService->autorizeUser($book);

        $validatedData = $this->bookService->validateRequest($request);
        $validatedData['img'] = $this->bookService->handleImageUpload($request, $book);

        $this->bookRepository->updateBook($book, $validatedData);

        return response()->json(['message' => 'Book updated!', 'book' => $book]);
    }

    public function destroy(Book $book)
    {
        $this->bookService->autorizeUser($book);

        $this->bookRepository->deleteBook($book);

        return response()->json(['message' => 'Book deleted!']);
    }
}
