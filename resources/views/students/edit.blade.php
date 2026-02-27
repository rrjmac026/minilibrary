<x-app-layout>

<header class="topbar">
    <div>
        <h1>Edit Student</h1>
        <div class="topbar-breadcrumb">
            <a href="{{ route('students.index') }}">Students</a> / {{ $student->name }}
        </div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('students.show', $student) }}" class="btn btn-outline">← Back</a>
    </div>
</header>

<div class="content">
    <div class="page-card" style="max-width:640px;">
        <div class="page-card-header">
            <span class="page-card-title">Edit Information</span>
        </div>
        <div style="padding:28px;">
            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf @method('PUT')
                <div class="form-grid form-grid-2">

                    <div class="form-group full">
                        <label class="form-label">Full Name <span>*</span></label>
                        <input type="text" name="name" value="{{ old('name', $student->name) }}"
                            class="form-input {{ $errors->has('name') ? 'error' : '' }}">
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Student ID <span>*</span></label>
                        <input type="text" name="student_id" value="{{ old('student_id', $student->student_id) }}"
                            class="form-input {{ $errors->has('student_id') ? 'error' : '' }}">
                        @error('student_id') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Course <span>*</span></label>
                        <input type="text" name="course" value="{{ old('course', $student->course) }}"
                            class="form-input {{ $errors->has('course') ? 'error' : '' }}">
                        @error('course') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group full">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}"
                            class="form-input {{ $errors->has('email') ? 'error' : '' }}">
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div style="display:flex;gap:10px;margin-top:28px;padding-top:20px;border-top:1px solid var(--border);">
                    <button type="submit" class="btn btn-primary">Update Student</button>
                    <a href="{{ route('students.show', $student) }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>