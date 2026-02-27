<x-app-layout>

<header class="topbar">
    <div>
        <h1>New Student</h1>
        <div class="topbar-breadcrumb">Register a new student</div>
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
        <form method="POST" action="{{ route('students.store') }}" style="display:flex;flex-direction:column;gap:24px;">
            @csrf

            <!-- Student ID -->
            <div>
                <label class="form-label">Student ID *</label>
                <input type="text" name="student_id" class="form-input" value="{{ old('student_id') }}" placeholder="e.g. STU-2024-001" required>
                @error('student_id')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Full Name -->
            <div>
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Student full name" required>
                @error('name')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="student@example.com">
                @error('email')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Course -->
            <div>
                <label class="form-label">Course *</label>
                <input type="text" name="course" class="form-input" value="{{ old('course') }}" placeholder="e.g. Bachelor of Science in Computer Science" required>
                @error('course')
                <div style="color:#c72d2d;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Actions -->
            <div style="display:flex;gap:8px;margin-top:16px;">
                <button type="submit" class="btn btn-primary">Create Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

</x-app-layout>