<x-app-layout>

<header class="topbar">
    <div>
        <h1>New Borrow</h1>
        <div class="topbar-breadcrumb">Create a new borrow record</div>
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
        <form method="POST" action="{{ route('borrows.store') }}" style="display:flex;flex-direction:column;gap:24px;">
            @csrf

            <!-- Student Selection -->
            <div>
                <label class="form-label">Student *</label>
                <select name="student_id" class="form-input" required>
                    <option value="">Select a student</option>
                    @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                        {{ $student->name }} ({{ $student->student_id }})
                    </option>
                    @endforeach
                </select>
                @error('student_id')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Borrow Date -->
            <div>
                <label class="form-label">Borrow Date *</label>
                <input type="date" name="borrow_date" class="form-input" value="{{ old('borrow_date', now()->format('Y-m-d')) }}" required>
                @error('borrow_date')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Due Date -->
            <div>
                <label class="form-label">Due Date *</label>
                <input type="date" name="due_date" class="form-input" value="{{ old('due_date') }}" required>
                @error('due_date')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Books Selection -->
            <div>
                <label class="form-label">Select Books *</label>
                <div style="display:grid;gap:8px;margin-top:8px;">
                    @foreach($books as $book)
                    <label style="display:flex;align-items:center;gap:8px;padding:10px;background:var(--bg-secondary);border-radius:6px;cursor:pointer;">
                        <input type="checkbox" name="books[]" value="{{ $book->id }}" 
                            {{ in_array($book->id, old('books', [])) ? 'checked' : '' }}
                            {{ !$book->isAvailable() ? 'disabled' : '' }}>
                        <div style="flex:1;">
                            <div style="font-weight:500;font-size:13px;">{{ $book->title }}</div>
                            <div style="font-size:11px;color:var(--muted);">
                                Available: <span style="font-weight:500;">{{ $book->available_copies }}</span> / {{ $book->total_copies }}
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('books')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="form-label">Status</label>
                <select name="status" class="form-input">
                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="returned" {{ old('status') === 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="overdue" {{ old('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>

            <!-- Actions -->
            <div style="display:flex;gap:8px;margin-top:16px;">
                <button type="submit" class="btn btn-primary">Create Borrow</button>
                <a href="{{ route('borrows.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
