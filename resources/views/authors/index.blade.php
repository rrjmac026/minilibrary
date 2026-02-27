<x-app-layout>

<style>
/* ── PAGE-LEVEL OVERRIDES ── */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap');

.authors-topbar {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    padding: 0 32px;
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    gap: 16px;
    position: sticky;
    top: 0;
    z-index: 40;
}

.authors-topbar-left {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px 0;
}

.authors-topbar-eyebrow {
    font-size: 10px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 3px;
}

.authors-topbar h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: 26px;
    letter-spacing: -0.5px;
    color: var(--ink);
    line-height: 1;
}

.authors-topbar h1 em {
    font-style: italic;
    color: var(--accent);
}

.topbar-divider {
    width: 1px;
    height: 36px;
    background: var(--border);
    flex-shrink: 0;
}

.total-badge {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.total-badge-num {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 900;
    color: var(--ink);
    line-height: 1;
}

.total-badge-label {
    font-size: 10px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--muted);
}

.authors-topbar-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ── CONTENT ── */
.authors-content {
    padding: 32px;
}

/* ── ALERT ── */
.alert-success {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: #edf7f2;
    border: 1px solid #b6dfc9;
    border-radius: 8px;
    font-size: 13px;
    color: #1a5c38;
    margin-bottom: 24px;
}

/* ── SEARCH / FILTER BAR ── */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
}

.filter-input-wrap {
    position: relative;
    flex: 1;
    max-width: 340px;
}

.filter-input-wrap svg {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
}

.filter-input {
    width: 100%;
    padding: 9px 12px 9px 36px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13px;
    font-family: 'DM Sans', sans-serif;
    color: var(--ink);
    background: var(--surface);
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
}

.filter-input:focus {
    border-color: var(--ink);
    box-shadow: 0 0 0 3px rgba(26,24,20,0.06);
}

.filter-view-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--surface);
    font-size: 12px;
    color: var(--muted);
    cursor: pointer;
    transition: all 0.15s;
    font-family: 'DM Sans', sans-serif;
}

.filter-view-btn:hover, .filter-view-btn.active {
    border-color: var(--ink);
    color: var(--ink);
    background: var(--bg);
}

/* ── CARD GRID ── */
.authors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 16px;
}

.author-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    animation: cardIn 0.4s ease both;
    position: relative;
}

.author-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(26,24,20,0.1);
    border-color: #d0ccc4;
}

@keyframes cardIn {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* stagger */
.author-card:nth-child(1)  { animation-delay: 0.05s; }
.author-card:nth-child(2)  { animation-delay: 0.10s; }
.author-card:nth-child(3)  { animation-delay: 0.15s; }
.author-card:nth-child(4)  { animation-delay: 0.20s; }
.author-card:nth-child(5)  { animation-delay: 0.25s; }
.author-card:nth-child(6)  { animation-delay: 0.30s; }
.author-card:nth-child(7)  { animation-delay: 0.35s; }
.author-card:nth-child(8)  { animation-delay: 0.40s; }
.author-card:nth-child(9)  { animation-delay: 0.45s; }
.author-card:nth-child(10) { animation-delay: 0.50s; }

/* coloured top band */
.card-band {
    height: 5px;
    width: 100%;
}

.card-body {
    padding: 22px 22px 18px;
}

.card-header {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 14px;
}

.card-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: 17px;
    color: #fff;
    flex-shrink: 0;
    letter-spacing: -0.5px;
}

.card-meta {
    flex: 1;
    min-width: 0;
}

.card-name {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 16px;
    color: var(--ink);
    letter-spacing: -0.3px;
    line-height: 1.2;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-email {
    font-size: 11px;
    color: var(--muted);
    font-family: 'DM Mono', monospace;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-bio {
    font-size: 12.5px;
    color: var(--muted);
    line-height: 1.65;
    margin-bottom: 16px;
    min-height: 40px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--border);
}

.card-book-count {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--muted);
}

.card-book-num {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 20px;
    color: var(--ink);
    line-height: 1;
}

.card-book-label {
    font-size: 10px;
    letter-spacing: 0.5px;
    color: var(--muted);
    line-height: 1.3;
}

.card-actions {
    display: flex;
    align-items: center;
    gap: 4px;
    opacity: 0;
    transition: opacity 0.15s;
}

.author-card:hover .card-actions {
    opacity: 1;
}

/* ── TABLE FALLBACK (for list view toggle) ── */
.authors-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    display: none;
}

.authors-table-wrap.visible {
    display: block;
}

.authors-grid.hidden {
    display: none;
}

/* ── EMPTY STATE ── */
.empty-authors {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 24px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
}

.empty-authors-glyph {
    font-family: 'Playfair Display', serif;
    font-size: 64px;
    font-style: italic;
    color: var(--border);
    line-height: 1;
    margin-bottom: 16px;
}

.empty-authors-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 20px;
    color: var(--ink);
    margin-bottom: 8px;
}

.empty-authors-desc {
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 24px;
}

/* ── PAGINATION ── */
.pagination-wrap {
    margin-top: 24px;
}
</style>

{{-- TOPBAR --}}
<header class="authors-topbar">
    <div class="authors-topbar-left">
        <div>
            <div class="authors-topbar-eyebrow">Catalog</div>
            <h1>Book <em>Authors</em></h1>
        </div>
        <div class="topbar-divider"></div>
        <div class="total-badge">
            <div class="total-badge-num">{{ $authors->total() }}</div>
            <div class="total-badge-label">Total Authors</div>
        </div>
    </div>
    <div class="authors-topbar-right">
        <button class="filter-view-btn active" id="btn-grid" onclick="setView('grid')">
            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Grid
        </button>
        <button class="filter-view-btn" id="btn-list" onclick="setView('list')">
            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
            List
        </button>
        <a href="{{ route('authors.create') }}" class="btn btn-primary">
            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
            Add Author
        </a>
    </div>
</header>

<div class="authors-content">

    @if(session('success'))
    <div class="alert-success">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- SEARCH BAR --}}
    <div class="filter-bar">
        <div class="filter-input-wrap">
            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
            <input type="text" class="filter-input" placeholder="Search authors by name…" id="authorSearch">
        </div>
    </div>

    {{-- CARD GRID --}}
    <div class="authors-grid" id="authorsGrid">
        @forelse($authors as $author)
        @php
            $palette = [
                ['bg' => '#e8572a', 'band' => 'linear-gradient(90deg,#e8572a,#f0845a)'],
                ['bg' => '#2a7ae8', 'band' => 'linear-gradient(90deg,#2a7ae8,#5a9ef0)'],
                ['bg' => '#2a9e6e', 'band' => 'linear-gradient(90deg,#2a9e6e,#4abf8a)'],
                ['bg' => '#c9942a', 'band' => 'linear-gradient(90deg,#c9942a,#e8b84b)'],
                ['bg' => '#7c3aed', 'band' => 'linear-gradient(90deg,#7c3aed,#a270f5)'],
                ['bg' => '#0891b2', 'band' => 'linear-gradient(90deg,#0891b2,#22b8d8)'],
            ];
            $p = $palette[$author->id % count($palette)];
        @endphp
        <div class="author-card" data-name="{{ strtolower($author->name) }}">
            <div class="card-band" style="background: {{ $p['band'] }};"></div>
            <div class="card-body">
                <div class="card-header">
                    <div class="card-avatar" style="background: {{ $p['bg'] }};">
                        {{ strtoupper(substr($author->name, 0, 2)) }}
                    </div>
                    <div class="card-meta">
                        <div class="card-name" title="{{ $author->name }}">{{ $author->name }}</div>
                        <div class="card-email">{{ $author->email ?? 'No email on record' }}</div>
                    </div>
                </div>

                <p class="card-bio">{{ $author->bio ?? 'No biography has been added for this author yet.' }}</p>

                <div class="card-footer">
                    <div style="display:flex;align-items:baseline;gap:5px;">
                        <span class="card-book-num">{{ $author->books_count }}</span>
                        <div class="card-book-label">{{ Str::plural('book', $author->books_count) }}<br>authored</div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('authors.show', $author) }}" class="btn btn-outline btn-sm">View</a>
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('authors.destroy', $author) }}" onsubmit="return confirm('Delete {{ $author->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-ghost btn-sm" title="Delete">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-authors">
            <div class="empty-authors-glyph">✍</div>
            <div class="empty-authors-title">No authors yet</div>
            <div class="empty-authors-desc">Add authors before creating books in the catalog.</div>
            <a href="{{ route('authors.create') }}" class="btn btn-primary">+ Add First Author</a>
        </div>
        @endforelse
    </div>

    {{-- LIST VIEW (hidden by default) --}}
    <div class="authors-table-wrap" id="authorsTable">
        <table class="lib-table">
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Books</th>
                    <th>Bio</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                @php
                    $colors = ['#e8572a','#2a7ae8','#2a9e6e','#c9a84c','#7c3aed'];
                    $color  = $colors[$author->id % count($colors)];
                @endphp
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="av" style="background:{{ $color }}">{{ strtoupper(substr($author->name,0,2)) }}</div>
                            <span style="font-weight:500;">{{ $author->name }}</span>
                        </div>
                    </td>
                    <td style="font-size:12px;color:var(--muted);">{{ $author->email ?? '—' }}</td>
                    <td><span class="chip chip-blue">{{ $author->books_count }} {{ Str::plural('book', $author->books_count) }}</span></td>
                    <td style="font-size:12px;color:var(--muted);max-width:240px;">{{ $author->bio ? Str::limit($author->bio, 60) : '—' }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:6px;justify-content:flex-end;">
                            <a href="{{ route('authors.show', $author) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('authors.destroy', $author) }}" onsubmit="return confirm('Delete {{ $author->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm">
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">
                    <div class="empty-state">
                        <div class="empty-icon">✍️</div>
                        <div class="empty-title">No authors yet</div>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($authors->hasPages())
    <div class="pagination-wrap">{{ $authors->links() }}</div>
    @endif
</div>

<script>
// Grid / List toggle
function setView(v) {
    const grid = document.getElementById('authorsGrid');
    const table = document.getElementById('authorsTable');
    const btnGrid = document.getElementById('btn-grid');
    const btnList = document.getElementById('btn-list');
    if (v === 'grid') {
        grid.classList.remove('hidden');
        table.classList.remove('visible');
        btnGrid.classList.add('active');
        btnList.classList.remove('active');
    } else {
        grid.classList.add('hidden');
        table.classList.add('visible');
        btnList.classList.add('active');
        btnGrid.classList.remove('active');
    }
    localStorage.setItem('authors_view', v);
}

// Restore saved view preference
const saved = localStorage.getItem('authors_view');
if (saved === 'list') setView('list');

// Live search filter
document.getElementById('authorSearch').addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    document.querySelectorAll('.author-card').forEach(card => {
        const name = card.dataset.name || '';
        card.style.display = name.includes(q) ? '' : 'none';
    });
    // also filter table rows
    document.querySelectorAll('#authorsTable tbody tr').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(q) ? '' : 'none';
    });
});
</script>

</x-app-layout>