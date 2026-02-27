<x-app-layout>

<header class="topbar">
    <div>
        <h1>Edit Author</h1>
        <div class="topbar-breadcrumb"><a href="{{ route('authors.index') }}">Authors</a> / {{ $author->name }}</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('authors.show', $author) }}" class="btn btn-outline">← Back</a>
    </div>
</header>

<div class="content">
    <div class="page-card" style="max-width:640px;">
        <div class="page-card-header">
            <span class="page-card-title">Edit Author Information</span>
        </div>
        <div style="padding:28px;">
            <form method="POST" action="{{ route('authors.update', $author) }}">
                @csrf
                @method('PUT')
                <div class="form-grid">

                    <div class="form-group">
                        <label class="form-label">Full Name <span>*</span></label>
                        <input type="text" name="name" value="{{ old('name', $author->name) }}"
                            class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                            placeholder="e.g. Jose Rizal">
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $author->email) }}"
                            class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                            placeholder="author@email.com (optional)">
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Biography</label>
                        <textarea name="bio" class="form-input form-textarea {{ $errors->has('bio') ? 'error' : '' }}"
                            placeholder="Brief description about the author...">{{ old('bio', $author->bio) }}</textarea>
                        @error('bio') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div style="display:flex;gap:10px;margin-top:28px;padding-top:20px;border-top:1px solid var(--border);">
                    <button type="submit" class="btn btn-primary">Update Author</button>
                    <a href="{{ route('authors.show', $author) }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>