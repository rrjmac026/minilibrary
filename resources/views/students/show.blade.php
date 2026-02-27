<x-app-layout>

<header class="topbar">
    <div>
        <h1>{{ $student->name }}</h1>
        <div class="topbar-breadcrumb">
            <a href="{{ route('students.index') }}">Students</a> / Profile
        </div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-outline">Edit</a>
        <a href="{{ route('borrows.create') }}" class="btn btn-primary">+ New Borrow</a>
    </div>
</header>

<div class="content">

    {{-- PROFILE HEADER --}}
    <div class="page-card" style="margin-bottom:20px;">
        <div style="padding:28px;display:flex;align-items:center;gap:20px;">
            @php $colors = ['#e8572a','#2a7ae8','#2a9e6e','#c9a84c','#7c3aed']; $color = $colors[$student->id % count($colors)]; @endphp
            <div style="width:64px;height:64px;border-radius:50%;background:{{ $color }};display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:22px;color:#fff;flex-shrink:0;">
                {{ strtoupper(substr($student->name,0,2)) }}
            </div>
            <div style="flex:1;">
                <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:22px;letter-spacing:-0.5px;">{{ $student->name }}</div>
                <div style="font-size:13px;color:var(--muted);margin-top:2px;">{{ $student->course }} &nbsp;·&nbsp; <span style="font-family:'DM Mono',monospace;">{{ $student->student_id }}</span></div>
            </div>
            <div style="display:flex;gap:24px;text-align:center;">
                <div>
                    <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;">{{ $student->borrows->count() }}</div>
                    <div style="font-size:11px;color:var(--muted);letter-spacing:0.5px;">Total Borrows</div>
                </div>
                <div>
                    <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:var(--danger);">
                        ₱{{ number_format($student->borrows->sum(fn($b) => $b->computeFine()), 2) }}
                    </div>
                    <div style="font-size:11px;color:var(--muted);letter-spacing:0.5px;">Outstanding Fines</div>
                </div>
            </div>
        </div>
        <div class="detail-grid" style="border-top:1px solid var(--border);">
            <div class="detail-item">
                <div class="detail-label">Email</div>
                <div class="detail-value">{{ $student->email ?? '—' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Registered</div>
                <div class="detail-value">{{ $student->created_at->format('M d, Y') }}</div>
            </div>
        </div>
    </div>

    {{-- BORROW HISTORY --}}
    <div class="page-card">
        <div class="page-card-header">
            <span class="page-card-title">Borrow History</span>
            <a href="{{ route('borrows.create') }}" class="btn btn-primary btn-sm">+ New Borrow</a>
        </div>

        <div style="overflow-x:auto;">
            <table class="lib-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Books</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Fine</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($student->borrows as $borrow)
                    @php
                        $fine = $borrow->computeFine();
                        $status = $borrow->status;
                        if ($status === 'active' && \Carbon\Carbon::today()->gt($borrow->due_date)) $status = 'overdue';
                    @endphp
                    <tr>
                        <td style="font-family:'DM Mono',monospace;font-size:11px;color:var(--muted);">#{{ $borrow->id }}</td>
                        <td>
                            @foreach($borrow->borrowItems as $item)
                                <div style="font-size:12px;color:var(--ink);">{{ $item->book->title }}
                                    @if($item->returned) <span style="color:var(--success);font-size:10px;">✓</span> @endif
                                </div>
                            @endforeach
                        </td>
                        <td style="font-size:12px;">{{ $borrow->borrow_date->format('M d, Y') }}</td>
                        <td style="font-size:12px;">{{ $borrow->due_date->format('M d, Y') }}</td>
                        <td>
                            @if($status === 'overdue') <span class="chip chip-overdue">Overdue</span>
                            @elseif($status === 'returned') <span class="chip chip-returned">Returned</span>
                            @else <span class="chip chip-active">Active</span>
                            @endif
                        </td>
                        <td>
                            @if($fine > 0)
                                <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--danger);">₱{{ number_format($fine,2) }}</span>
                            @else <span style="color:var(--muted);">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('borrows.show', $borrow) }}" class="btn btn-outline btn-sm">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon">📋</div>
                            <div class="empty-title">No borrow records</div>
                            <div class="empty-desc">This student hasn't borrowed any books yet.</div>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</x-app-layout>