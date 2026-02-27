@extends('layouts.app')
@section('title', 'Students')

@php $title = 'Students'; @endphp

<x-app-layout>

<header class="topbar">
    <div>
        <h1>Students</h1>
        <div class="topbar-breadcrumb">Registry of all registered borrowers</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            Add Student
        </a>
    </div>
</header>

<div class="content">

    @if(session('success'))
    <div class="alert alert-success">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="page-card">
        <div class="page-card-header">
            <span class="page-card-title">All Students <span style="font-size:12px;color:var(--muted);font-weight:400;margin-left:8px;">{{ $students->total() }} total</span></span>
        </div>

        <div style="overflow-x:auto;">
            <table class="lib-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Student ID</th>
                        <th>Course</th>
                        <th>Email</th>
                        <th>Borrows</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    @php
                        $colors = ['#e8572a','#2a7ae8','#2a9e6e','#c9a84c','#7c3aed','#0891b2'];
                        $color  = $colors[$student->id % count($colors)];
                    @endphp
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="av" style="background:{{ $color }}">{{ strtoupper(substr($student->name,0,2)) }}</div>
                                <span style="font-weight:500;">{{ $student->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span style="font-family:'DM Mono',monospace;font-size:12px;color:var(--muted);">{{ $student->student_id }}</span>
                        </td>
                        <td style="font-size:13px;">{{ $student->course }}</td>
                        <td style="font-size:12px;color:var(--muted);">{{ $student->email ?? '—' }}</td>
                        <td>
                            <span class="chip chip-blue">{{ $student->borrows_count ?? $student->borrows()->count() }} records</span>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;justify-content:flex-end;">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-outline btn-sm">View</a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Delete {{ $student->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm">
                                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">🎓</div>
                                <div class="empty-title">No students yet</div>
                                <div class="empty-desc">Register the first student to get started.</div>
                                <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add Student</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($students->hasPages())
        <div class="pagination-wrap">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</div>

</x-app-layout>