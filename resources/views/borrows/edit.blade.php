<x-app-layout>

<header class="topbar">
    <div>
        <h1>Edit Borrow</h1>
        <div class="topbar-breadcrumb">Update borrow details for {{ $borrow->student->name }}</div>
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
        <form method="POST" action="{{ route('borrows.update', $borrow) }}" style="display:flex;flex-direction:column;gap:24px;">
            @csrf
            @method('PUT')

            <!-- Student Info (Read-only) -->
            <div>
                <label class="form-label">Student</label>
                <div style="padding:10px;background:var(--bg-secondary);border-radius:6px;border:1px solid var(--border);font-size:13px;font-weight:500;">
                    {{ $borrow->student->name }} ({{ $borrow->student->student_id }})
                </div>
            </div>

            <!-- Borrow Date -->
            <div>
                <label class="form-label">Borrow Date *</label>
                <input type="date" name="borrow_date" class="form-input" value="{{ old('borrow_date', $borrow->borrow_date->format('Y-m-d')) }}" required>
                @error('borrow_date')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Due Date -->
            <div>
                <label class="form-label">Due Date *</label>
                <input type="date" name="due_date" class="form-input" value="{{ old('due_date', $borrow->due_date->format('Y-m-d')) }}" required>
                @error('due_date')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="form-label">Status *</label>
                <select name="status" class="form-input" required>
                    <option value="active" {{ old('status', $borrow->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="returned" {{ old('status', $borrow->status) === 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="overdue" {{ old('status', $borrow->status) === 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
                @error('status')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Borrowed Books -->
            <div>
                <label class="form-label" style="margin-bottom:12px;">Borrowed Books</label>
                <div style="overflow-x:auto;">
                    <table class="lib-table" style="margin:0;">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>ISBN</th>
                                <th>Returned</th>
                                <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrow->borrowItems as $item)
                            <tr>
                                <td style="font-weight:500;font-size:13px;">{{ $item->book->title }}</td>
                                <td style="font-size:12px;color:var(--muted);">{{ $item->book->isbn ?? '—' }}</td>
                                <td>
                                    <span class="chip {{ $item->returned ? 'chip-active' : 'chip-overdue' }}">
                                        {{ $item->returned ? 'Returned' : 'Not Returned' }}
                                    </span>
                                </td>
                                <td style="font-weight:500;font-size:13px;">₱{{ number_format($item->computeItemFine(), 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Actions -->
            <div style="display:flex;gap:8px;margin-top:16px;">
                <button type="submit" class="btn btn-primary">Update Borrow</button>
                <a href="{{ route('borrows.show', $borrow) }}" class="btn btn-outline">View</a>
                <a href="{{ route('borrows.index') }}" class="btn btn-outline">Back</a>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
