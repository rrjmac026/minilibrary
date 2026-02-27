<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email|unique:students,email',
            'course'     => 'required|string|max:255',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load('borrows.borrowItems.book');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'name'       => 'required|string|max:255',
            'email'      => 'nullable|email|unique:students,email,' . $student->id,
            'course'     => 'required|string|max:255',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Student deleted successfully.');
    }
}