<x-app-layout>

<header class="topbar">
    <div>
        <h1>Edit Book</h1>
        <div class="topbar-breadcrumb">Update: {{ $book->title }}</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('books.show', $book) }}" class="btn btn-outline">← Back</a>
    </div>
</header>

<div class="content">

    @if($errors->any())
    <div class="alert alert-danger">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
        <div>
            <div style="font-weight:500;margin-bottom:4px;">There were errors with your submission</div>
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                <li style="font-size:13px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="page-card">
        <form method="POST" action="{{ route('books.update', $book) }}" style="display:flex;flex-direction:column;gap:24px;">
            @csrf
            @method('PUT')

            <!-- Book Title -->
            <div>
                <label class="form-label">Book Title *</label>
                <input type="text" name="title" class="form-input" value="{{ old('title', $book->title) }}" required>
                @error('title')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- ISBN -->
            <div>
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-input" value="{{ old('isbn', $book->isbn) }}">
                @error('isbn')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="form-label">Description</label>
                <textarea name="description" class="form-input" style="min-height:120px;resize:vertical;">{{ old('description', $book->description) }}</textarea>
                @error('description')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Authors Selection -->
            <div>
                <label class="form-label">Authors *</label>
                <div style="display:grid;gap:8px;margin-top:8px;">
                    @forelse($authors as $author)
                    <label style="display:flex;align-items:center;gap:8px;padding:10px;background:var(--bg-secondary);border-radius:6px;cursor:pointer;">
                        <input type="checkbox" name="author_ids[]" value="{{ $author->id }}"
                            {{ $book->authors->contains($author->id) ? 'checked' : '' }}>
                        <div>
                            <div style="font-weight:500;font-size:13px;">{{ $author->name }}</div>
                            @if($author->email)
                            <div style="font-size:11px;color:var(--muted);">{{ $author->email }}</div>
                            @endif
                        </div>
                    </label>
                    @empty
                    <div style="padding:15px;background:#fef3f2;border-radius:6px;border:1px solid #fecdd3;color:#c72d2d;font-size:13px;">
                        No authors available. <a href="{{ route('authors.create') }}" style="text-decoration:underline;font-weight:500;">Create an author first</a>
                    </div>
                    @endforelse
                </div>
                @error('author_ids')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total Copies -->
            <div>
                <label class="form-label">Total Copies *</label>
                <input type="number" name="total_copies" class="form-input" value="{{ old('total_copies', $book->total_copies) }}" min="1" required>
                @error('total_copies')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Available Copies -->
            <div>
                <label class="form-label">Available Copies *</label>
                <input type="number" name="available_copies" class="form-input" value="{{ old('available_copies', $book->available_copies) }}" min="0" required>
                @error('available_copies')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Actions -->
            <div style="display:flex;gap:8px;margin-top:16px;">
                <button type="submit" class="btn btn-primary">Update Book</button>
                <a href="{{ route('books.show', $book) }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

</x-app-layout>