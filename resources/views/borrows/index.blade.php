<x-app-layout>

<header class="topbar">
    <div>
        <h1>Borrows</h1>
        <div class="topbar-breadcrumb">Track student book borrowing</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('borrows.create') }}" class="btn btn-primary">
            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            New Borrow
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
            <span class="page-card-title">All Borrows <span style="font-size:12px;color:var(--muted);font-weight:400;margin-left:8px;">{{ $borrows->total() }} records</span></span>
        </div>

        <div style="overflow-x:auto;">
            <table class="lib-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Books</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Fine</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrows as $borrow)
                    @php
                        $statusColor = $borrow->status === 'active' ? 'chip-active' : ($borrow->status === 'overdue' ? 'chip-overdue' : 'chip-returned');
                        $fine = $borrow->computeFine();
                    @endphp
                    <tr>
                        <td>
                            <div style="font-weight:500;font-size:13px;">{{ $borrow->student->name }}</div>
                            <div style="font-size:11px;color:var(--muted);margin-top:2px;">{{ $borrow->student->student_id }}</div>
                        </td>
                        <td style="font-size:13px;color:var(--muted);">
                            {{ $borrow->borrowItems->count() }} item(s)
                        </td>
                        <td style="font-size:13px;">{{ $borrow->borrow_date->format('M d, Y') }}</td>
                        <td style="font-size:13px;">{{ $borrow->due_date->format('M d, Y') }}</td>
                        <td>
                            <span class="chip {{ $statusColor }}">{{ ucfirst($borrow->status) }}</span>
                        </td>
                        <td style="font-weight:500;font-size:13px;">₱{{ number_format($fine, 2) }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;justify-content:flex-end;">
                                <a href="{{ route('borrows.show', $borrow) }}" class="btn btn-outline btn-sm">View</a>
                                <a href="{{ route('borrows.edit', $borrow) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('borrows.destroy', $borrow) }}" onsubmit="return confirm('Delete this borrow record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm">
                                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon">📚</div>
                            <div class="empty-title">No borrow records yet</div>
                            <div class="empty-desc">Create a new borrow record to track student book borrowing.</div>
                            <a href="{{ route('borrows.create') }}" class="btn btn-primary">+ New Borrow</a>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($borrows->hasPages())
        <div class="pagination-wrap">{{ $borrows->links() }}</div>
        @endif
    </div>
</div>

</x-app-layout>
