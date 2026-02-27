<x-app-layout>

<header class="topbar">
    <div>
        <h1>Borrow Details</h1>
        <div class="topbar-breadcrumb">Record #{{ $borrow->id }} - {{ $borrow->student->name }}</div>
    </div>
    <div class="topbar-right">
        <a href="{{ route('borrows.edit', $borrow) }}" class="btn btn-outline">Edit</a>
    </div>
</header>

<div class="content">

    @if(session('success'))
    <div class="alert alert-success">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
        <!-- Main Content -->
        <div>
            <!-- Student Information -->
            <div class="page-card">
                <div class="page-card-header">
                    <span class="page-card-title">Student Information</span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Student Name</div>
                        <div style="font-weight:500;font-size:14px;">{{ $borrow->student->name }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Student ID</div>
                        <div style="font-weight:500;font-size:14px;">{{ $borrow->student->student_id }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Course</div>
                        <div style="font-weight:500;font-size:14px;">{{ $borrow->student->course ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Email</div>
                        <div style="font-weight:500;font-size:14px;">{{ $borrow->student->email ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Borrow Details -->
            <div class="page-card">
                <div class="page-card-header">
                    <span class="page-card-title">Borrow Details</span>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Borrow Date</div>
                        <div style="font-weight:500;font-size:14px;">{{ $borrow->borrow_date->format('M d, Y') }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Due Date</div>
                        <div style="font-weight:500;font-size:14px;">{{ $borrow->due_date->format('M d, Y') }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Days Remaining</div>
                        <div style="font-weight:500;font-size:14px;">
                            @php
                                $daysRemaining = now()->diffInDays($borrow->due_date, false);
                                $isOverdue = $daysRemaining < 0;
                            @endphp
                            @if($isOverdue)
                            <span style="color:#c72d2d;">{{ abs($daysRemaining) }} days overdue</span>
                            @else
                            <span style="color:#2a7f2a;">{{ $daysRemaining }} days remaining</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;text-transform:uppercase;margin-bottom:4px;">Status</div>
                        <div style="font-weight:500;font-size:14px;">
                            @php
                                $statusColor = $borrow->status === 'active' ? 'chip-active' : ($borrow->status === 'overdue' ? 'chip-overdue' : 'chip-returned');
                            @endphp
                            <span class="chip {{ $statusColor }}">{{ ucfirst($borrow->status) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Borrowed Books -->
            <div class="page-card">
                <div class="page-card-header">
                    <span class="page-card-title">Borrowed Books <span style="font-size:12px;color:var(--muted);font-weight:400;margin-left:8px;">{{ $borrow->borrowItems->count() }} item(s)</span></span>
                </div>

                <div style="overflow-x:auto;">
                    <table class="lib-table">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>ISBN</th>
                                <th>Authors</th>
                                <th>Status</th>
                                <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrow->borrowItems as $item)
                            @php
                                $itemFine = $item->computeItemFine();
                            @endphp
                            <tr>
                                <td style="font-weight:500;font-size:13px;">{{ $item->book->title }}</td>
                                <td style="font-family:'DM Mono',monospace;font-size:12px;color:var(--muted);">{{ $item->book->isbn ?? '—' }}</td>
                                <td style="font-size:12px;color:var(--muted);">
                                    @foreach($item->book->authors as $author)
                                    <span style="display:inline-block;background:#f0ede8;color:var(--ink);padding:2px 6px;border-radius:99px;margin-right:4px;font-size:11px;">{{ $author->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="chip {{ $item->returned ? 'chip-active' : 'chip-overdue' }}">
                                        {{ $item->returned ? 'Returned' : 'Not Returned' }}
                                    </span>
                                </td>
                                <td style="font-weight:500;font-size:13px;">{{ $itemFine > 0 ? '₱' . number_format($itemFine, 2) : '—' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5">
                                <div style="text-align:center;padding:20px;color:var(--muted);font-size:13px;">No books in this borrow record</div>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Total Fine Summary -->
            <div class="page-card">
                <div class="page-card-header">
                    <span class="page-card-title">Fine Summary</span>
                </div>
                @php
                    $totalFine = $borrow->computeFine();
                @endphp
                <div style="padding:20px;background:var(--bg-secondary);border-radius:6px;text-align:center;margin-bottom:16px;">
                    <div style="font-size:12px;color:var(--muted);margin-bottom:8px;">Total Fine</div>
                    <div style="font-size:32px;font-weight:700;color:{{ $totalFine > 0 ? '#c72d2d' : '#2a7f2a' }};">₱{{ number_format($totalFine, 2) }}</div>
                </div>

                <div style="font-size:12px;color:var(--muted);line-height:1.6;">
                    <p style="margin:0 0 8px 0;">Fine calculation: <strong>₱10 per day per unreturned book</strong></p>
                    <p style="margin:0;">Unreturned books: <strong>{{ $borrow->borrowItems->where('returned', false)->count() }}</strong></p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="page-card">
                <div class="page-card-header">
                    <span class="page-card-title">Actions</span>
                </div>
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <a href="{{ route('borrows.edit', $borrow) }}" class="btn btn-outline" style="width:100%;text-align:center;">Edit Record</a>
                    <form method="POST" action="{{ route('borrows.destroy', $borrow) }}" onsubmit="return confirm('Delete this borrow record?');" style="width:100%;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-ghost" style="width:100%;text-align:center;">Delete Record</button>
                    </form>
                    <a href="{{ route('borrows.index') }}" class="btn btn-outline" style="width:100%;text-align:center;">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
