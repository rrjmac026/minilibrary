<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Student;
use App\Models\Author;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks    = Book::sum('total_copies');
        $totalStudents = Student::count();
        $totalAuthors  = Author::count();
        $activeBorrows = Borrow::where('status', 'active')->count();
        $overdueBorrows = Borrow::where('status', 'active')
                                ->where('due_date', '<', Carbon::today())
                                ->count();

        $recentBorrows = Borrow::with('student', 'borrowItems.book')
                               ->latest()
                               ->take(5)
                               ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalStudents',
            'totalAuthors',
            'activeBorrows',
            'overdueBorrows',
            'recentBorrows'
        ));
    }
}