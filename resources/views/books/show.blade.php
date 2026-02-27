<x-app-layout>

<header class="topbar">
    <div>
        <h1>{{ Str::limit($book->title, 40) }}</h1>
        <div class="topbar-breadcrumb"><a href="{{ route('books.index') }}">Books</a> / Detail</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-outline">Edit</a>
        <a href="{{ route('borrows.create') }}" class="btn btn-primary">+ Borrow This</a>
    </div>
</header>

<div class="content">

    <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;margin-bottom:20px;">

        {{-- BOOK DETAIL --}}
        <div class="page-card">
            <div style="padding:28px;">
                <div style="display:flex;align-items:flex-start;gap:20px;">
                    <div style="width:56px;height:70px;background:linear-gradient(135deg,var(--accent),var(--gold));border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;">📖</div>
                    <div style="flex:1;">
                        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:20px;letter-spacing:-0.5px;margin-bottom:6px;">{{ $book->title }}</div>
                        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px;">
                            @foreach($book->authors as $author)
                            <a href="{{ route('authors.show', $author) }}" style="font-size:12px;background:#f0ede8;color:var(--ink);padding:3px 10px;border-radius:99px;text-decoration:none;transition:background 0.15s;" onmouseover="this.style.background='#e8e4dc'" onmouseout="this.style.background='#f0ede8'">{{ $author->name }}</a>
                            @endforeach
                        </div>
                        @if($book->description)
                        <p style="font-size:13.5px;color:var(--muted);line-height:1.7;">{{ $book->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="detail-grid" style="border-top:1px solid var(--border);">
                <div class="detail-item">
                    <div class="detail-label">ISBN</div>
                    <div class="detail-value" style="font-family:'DM Mono',monospace;font-size:13px;">{{ $book->isbn ?? '—' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Added</div>
                    <div class="detail-value">{{ $book->created_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>

        {{-- INVENTORY CARD --}}
        <div style="display:flex;flex-direction:column;gap:16px;">
            <div class="page-card">
                <div style="padding:22px;text-align:center;">
                    @php $pct = $book->total_copies > 0 ? ($book->available_copies / $book->total_copies) * 100 : 0; @endphp
                    <div style="font-family:'Syne',sans-serif;font-size:48px;font-weight:800;color:{{ $book->available_copies > 0 ? 'var(--success)' : 'var(--danger)' }};line-height:1;">{{ $book->available_copies }}</div>
                    <div style="font-size:12px;color:var(--muted);margin-top:4px;">of {{ $book->total_copies }} copies available</div>
                    <div style="margin-top:14px;height:6px;background:var(--border);border-radius:99px;overflow:hidden;">
                        <div style="height:100%;width:{{ $pct }}%;background:{{ $pct >= 60 ? 'var(--success)' : ($pct >= 30 ? 'var(--warn)' : 'var(--danger)') }};border-radius:99px;transition:width 0.6s;"></div>
                    </div>
                    <div style="font-size:11px;color:var(--muted);margin-top:8px;">{{ $book->total_copies - $book->available_copies }} currently borrowed</div>
                </div>
            </div>

            <div class="page-card">
                <div style="padding:16px;display:flex;flex-direction:column;gap:8px;">
                    <a href="{{ route('borrows.create') }}" class="btn btn-primary" style="justify-content:center;">📋 Borrow This Book</a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-outline" style="justify-content:center;">✏️ Edit Details</a>
                    <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Delete this book?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline" style="width:100%;justify-content:center;color:var(--danger);border-color:var(--danger);">🗑 Delete Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- BORROW HISTORY --}}
    <div class="page-card">
        <div class="page-card-header">
            <span class="page-card-title">Borrow History</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="lib-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Borrowed</th>
                        <th>Due Date</th>
                        <th>Returned</th>
                        <th>Fine</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($book->borrowItems as $item)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                @php $colors = ['#e8572a','#2a7ae8','#2a9e6e','#c9a84c','#7c3aed']; $c = $colors[$item->borrow->student->id % count($colors)]; @endphp
                                <div class="av" style="background:{{ $c }}">{{ strtoupper(substr($item->borrow->student->name,0,2)) }}</div>
                                <div>
                                    <div style="font-size:13px;font-weight:500;">{{ $item->borrow->student->name }}</div>
                                    <div style="font-size:11px;color:var(--muted);font-family:'DM Mono',monospace;">{{ $item->borrow->student->student_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:12px;">{{ $item->borrow->borrow_date->format('M d, Y') }}</td>
                        <td style="font-size:12px;">{{ $item->borrow->due_date->format('M d, Y') }}</td>
                        <td>
                            @if($item->returned)
                                <span class="chip chip-active">{{ $item->returned_at?->format('M d, Y') ?? 'Yes' }}</span>
                            @else
                                <span class="chip chip-overdue">Not returned</span>
                            @endif
                        </td>
                        <td>
                            @if($item->fine > 0)
                                <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--danger);">₱{{ number_format($item->fine,2) }}</span>
                            @else <span style="color:var(--muted);">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <div class="empty-icon">📋</div>
                            <div class="empty-title">No borrow history</div>
                            <div class="empty-desc">This book hasn't been borrowed yet.</div>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</x-app-layout>