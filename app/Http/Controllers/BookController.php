<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('authors')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::orderBy('name')->get();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'isbn'            => 'nullable|string|unique:books,isbn',
            'description'     => 'nullable|string',
            'total_copies'    => 'required|integer|min:1',
            'authors'         => 'required|array|min:1',
            'authors.*'       => 'exists:authors,id',
        ]);

        $book = Book::create([
            'title'            => $request->title,
            'isbn'             => $request->isbn,
            'description'      => $request->description,
            'total_copies'     => $request->total_copies,
            'available_copies' => $request->total_copies, // initially all available
        ]);

        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')
                         ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load('authors');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors        = Author::orderBy('name')->get();
        $selectedAuthors = $book->authors->pluck('id')->toArray();
        return view('books.edit', compact('book', 'authors', 'selectedAuthors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'isbn'         => 'nullable|string|unique:books,isbn,' . $book->id,
            'description'  => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'authors'      => 'required|array|min:1',
            'authors.*'    => 'exists:authors,id',
        ]);

        // Adjust available copies if total copies changed
        $difference = $request->total_copies - $book->total_copies;

        $book->update([
            'title'            => $request->title,
            'isbn'             => $request->isbn,
            'description'      => $request->description,
            'total_copies'     => $request->total_copies,
            'available_copies' => max(0, $book->available_copies + $difference),
        ]);

        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')
                         ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Book deleted successfully.');
    }
}