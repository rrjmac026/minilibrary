<x-app-layout>

<header class="topbar">
    <div>
        <h1> Create New Book Page</h1>
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
        <form method="POST" action="{{ route('books.store') }}" style="display:flex;flex-direction:column;gap:24px;">
            @csrf

            <!-- Book Title -->
            <div>
                <label class="form-label">Book Title *</label>
                <input type="text" name="title" class="form-input" value="{{ old('title') }}" placeholder="Enter book title" required>
                @error('title')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- ISBN -->
            <div>
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-input" value="{{ old('isbn') }}" placeholder="e.g. 978-0-123456-78-9">
                @error('isbn')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="form-label">Description</label>
                <textarea name="description" class="form-input" style="min-height:120px;resize:vertical;" placeholder="Book description or summary">{{ old('description') }}</textarea>
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
                        <input type="checkbox" name="authors[]" value="{{ $author->id }}"
                            {{ in_array($author->id, old('authors', [])) ? 'checked' : '' }}>
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
                @error('authors')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total Copies -->
            <div>
                <label class="form-label">Total Copies *</label>
                <input type="number" name="total_copies" class="form-input" value="{{ old('total_copies', 1) }}" min="1" required>
                @error('total_copies')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Available Copies -->
            <div>
                <label class="form-label">Available Copies *</label>
                <input type="number" name="available_copies" class="form-input" value="{{ old('available_copies', 1) }}" min="0" required>
                @error('available_copies')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Actions -->
            <div style="display:flex;gap:8px;margin-top:16px;">
                <button type="submit" class="btn btn-primary">Create Book</button>
                <a href="{{ route('books.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

</x-app-layout>