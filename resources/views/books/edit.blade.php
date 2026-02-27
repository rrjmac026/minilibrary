<x-app-layout>

<header class="topbar">
    <div>
        <h1>Books</h1>
        <div class="topbar-breadcrumb">Catalog & inventory management</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            Add Book
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
            <span class="page-card-title">All Books <span style="font-size:12px;color:var(--muted);font-weight:400;margin-left:8px;">{{ $books->total() }} titles</span></span>
        </div>

        <div style="overflow-x:auto;">
            <table class="lib-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>ISBN</th>
                        <th>Available</th>
                        <th>Total</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    @php
                        $pct = $book->total_copies > 0 ? ($book->available_copies / $book->total_copies) * 100 : 0;
                        $availColor = $pct >= 60 ? 'chip-active' : ($pct >= 30 ? 'chip-gold' : 'chip-overdue');
                    @endphp
                    <tr>
                        <td>
                            <div style="font-weight:500;font-size:13px;">{{ $book->title }}</div>
                            @if($book->description)
                            <div style="font-size:11px;color:var(--muted);margin-top:2px;">{{ Str::limit($book->description,55) }}</div>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;flex-wrap:wrap;gap:4px;">
                                @foreach($book->authors as $author)
                                <span style="font-size:11px;background:#f0ede8;color:var(--ink);padding:2px 8px;border-radius:99px;">{{ $author->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td style="font-family:'DM Mono',monospace;font-size:12px;color:var(--muted);">{{ $book->isbn ?? '—' }}</td>
                        <td>
                            <span class="chip {{ $availColor }}">{{ $book->available_copies }}</span>
                        </td>
                        <td style="font-size:13px;color:var(--muted);">{{ $book->total_copies }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;justify-content:flex-end;">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-outline btn-sm">View</a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-outline btn-sm">Edit</a>
                                <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Delete \'{{ $book->title }}\'?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm">
                                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">📚</div>
                            <div class="empty-title">No books yet</div>
                            <div class="empty-desc">Add authors first, then add books to the catalog.</div>
                            <a href="{{ route('books.create') }}" class="btn btn-primary">+ Add Book</a>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($books->hasPages())
        <div class="pagination-wrap">{{ $books->links() }}</div>
        @endif
    </div>
</div>

</x-app-layout>