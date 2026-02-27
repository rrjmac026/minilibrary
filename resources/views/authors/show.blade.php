<x-app-layout>

<header class="topbar">
    <div>
        <h1>{{ $author->name }}</h1>
        <div class="topbar-breadcrumb"><a href="{{ route('authors.index') }}">Authors</a> / Detail</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('authors.edit', $author) }}" class="btn btn-outline">Edit</a>
        <a href="{{ route('authors.index') }}" class="btn btn-outline">← Back</a>
    </div>
</header>

<div class="content">
    <div class="page-card" style="max-width:640px;">
        <div class="page-card-header">
            <span class="page-card-title">Author Information</span>
        </div>
        <div style="display:grid;grid-template-columns:1fr;gap:20px;padding:28px;">
            <div>
                <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Full Name</div>
                <div style="font-weight:500;font-size:14px;">{{ $author->name }}</div>
            </div>
            @if($author->email)
            <div>
                <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Email</div>
                <div style="font-size:14px;"><a href="mailto:{{ $author->email }}" style="color:var(--accent);text-decoration:none;">{{ $author->email }}</a></div>
            </div>
            @endif
            @if($author->bio)
            <div>
                <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Biography</div>
                <div style="font-size:13px;line-height:1.6;color:var(--muted);">{{ $author->bio }}</div>
            </div>
            @endif
            <div>
                <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Total Books</div>
                <div style="font-weight:500;font-size:14px;">{{ $author->books->count() }}</div>
            </div>
        </div>
    </div>

    @if($author->books->count() > 0)
    <div class="page-card">
        <div class="page-card-header">
            <span class="page-card-title">Books by {{ $author->name }}</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="lib-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>ISBN</th>
                        <th>Available</th>
                        <th>Total</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($author->books as $book)
                    <tr>
                        <td style="font-weight:500;font-size:13px;">{{ $book->title }}</td>
                        <td style="font-family:'DM Mono',monospace;font-size:12px;color:var(--muted);">{{ $book->isbn ?? '—' }}</td>
                        <td>{{ $book->available_copies }}</td>
                        <td style="color:var(--muted);">{{ $book->total_copies }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;justify-content:flex-end;">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-outline btn-sm">View</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

</x-app-layout>