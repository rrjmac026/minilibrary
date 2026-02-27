<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowItem;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with('student', 'borrowItems.book')
                         ->latest()
                         ->paginate(10);
        return view('borrows.index', compact('borrows'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        $books    = Book::where('available_copies', '>', 0)->orderBy('title')->get();
        return view('borrows.create', compact('students', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'due_date'   => 'required|date|after:today',
            'books'      => 'required|array|min:1',
            'books.*'    => 'exists:books,id',
        ]);

        // Check all selected books are still available
        foreach ($request->books as $bookId) {
            $book = Book::findOrFail($bookId);
            if ($book->available_copies < 1) {
                return back()->withErrors([
                    'books' => "The book '{$book->title}' is no longer available."
                ])->withInput();
            }
        }

        // Create borrow record
        $borrow = Borrow::create([
            'student_id'  => $request->student_id,
            'borrow_date' => Carbon::today(),
            'due_date'    => $request->due_date,
            'status'      => 'active',
        ]);

        // Create borrow items and decrement available copies
        foreach ($request->books as $bookId) {
            BorrowItem::create([
                'borrow_id' => $borrow->id,
                'book_id'   => $bookId,
                'returned'  => false,
                'fine'      => 0.00,
            ]);

            Book::where('id', $bookId)->decrement('available_copies');
        }

        return redirect()->route('borrows.index')
                         ->with('success', 'Books borrowed successfully.');
    }

    public function show(Borrow $borrow)
    {
        $borrow->load('student', 'borrowItems.book');
        $fine = $borrow->computeFine();
        return view('borrows.show', compact('borrow', 'fine'));
    }

    // Show return form
    public function returnForm(Borrow $borrow)
    {
        $borrow->load('student', 'borrowItems.book');

        // Only show unreturned items
        $unreturnedItems = $borrow->borrowItems->where('returned', false);

        if ($unreturnedItems->isEmpty()) {
            return redirect()->route('borrows.index')
                             ->with('info', 'All books have already been returned.');
        }

        $fine = $borrow->computeFine();

        return view('borrows.return', compact('borrow', 'unreturnedItems', 'fine'));
    }

    // Process return (partial or full)
    public function processReturn(Request $request, Borrow $borrow)
    {
        $request->validate([
            'items'   => 'required|array|min:1',
            'items.*' => 'exists:borrow_items,id',
        ]);

        $today   = Carbon::today();
        $dueDate = $borrow->due_date;

        $overdueDays = $today->gt($dueDate)
                       ? $today->diffInDays($dueDate)
                       : 0;

        foreach ($request->items as $itemId) {
            $item = BorrowItem::findOrFail($itemId);

            // Make sure item belongs to this borrow
            if ($item->borrow_id !== $borrow->id) {
                continue;
            }

            // Skip already returned items
            if ($item->returned) {
                continue;
            }

            // Compute and record fine for this item
            $itemFine = $overdueDays * 10;

            $item->update([
                'returned'    => true,
                'returned_at' => $today,
                'fine'        => $itemFine,
            ]);

            // Increment available copies
            Book::where('id', $item->book_id)->increment('available_copies');
        }

        // Update borrow status
        $allReturned = $borrow->borrowItems()->where('returned', false)->count() === 0;

        $borrow->update([
            'status' => $allReturned ? 'returned' : 'active',
        ]);

        return redirect()->route('borrows.index')
                         ->with('success', 'Books returned successfully.');
    }

    public function destroy(Borrow $borrow)
    {
        // Restore available copies for unreturned items before deleting
        foreach ($borrow->borrowItems->where('returned', false) as $item) {
            Book::where('id', $item->book_id)->increment('available_copies');
        }

        $borrow->delete();

        return redirect()->route('borrows.index')
                         ->with('success', 'Borrow record deleted.');
    }
}