@extends('layouts.app')

@section('title', 'History')

@section('content')
    <!-- History Page -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Message History</div>
            <div>
                <a href="{{ route('history.export', request()->query()) }}" class="btn">
                    <i class="fas fa-download"></i> Export Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ url('/history') }}">
                <div class="row mb-3 mt-3">
                    <div class="col-2">
                        <label>From Date</label>
                        <input type="date" name="from" class="filter-control" value="{{ request('from') }}">
                    </div>
                    <div class="col-2">
                        <label>To Date</label>
                        <input type="date" name="to" class="filter-control" value="{{ request('to') }}">
                    </div>
                    <div class="col-2">
                        <label>Status</label>
                        <select name="status" class="filter-control">
                            <option value="all">All Status</option>
                            @foreach(['success', 'pending', 'failed', 'error', 'rate_limited'] as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Search</label>
                        <input type="text" name="search" class="filter-control" placeholder="Search..." value="{{ request('search') }}">
                    </div>
                    <div class="col-3 mt-4">
                        <button class="btn"><i class="fas fa-filter"></i> Apply</button>
                        <a href="{{ url('/history') }}" class="btn btn-outline"><i class="fas fa-redo"></i> Reset</a>
                    </div>
                </div>
            </form>
            
            <div class="table-container">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th style="width: 20%">Date & Time</th>
                            <th style="width: 20%">to</th>
                            <th style="width: 50%">Message</th>
                            <th style="width: 10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $history)
                            <tr>
                                <td>{{ $history->sent_at ? $history->sent_at->format('d M Y, H:i') : '-' }}</td>
                                <td>
                                    @if(Str::startsWith($history->phone, ['[GROUP]', '[BULK]']))
                                        {{ Str::limit($history->phone, 20) }}
                                    @else
                                        {{ Str::limit(\App\Helpers\WhatsappHelper::formatPhoneDisplay($history->phone), 20) }}
                                    @endif
                                </td>
                                <td class="message-preview" title="{{ $history->message }}">
                                    {{ Str::limit($history->message, 60, '...') }}
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($history->status) {
                                            'success' => 'badge-success',
                                            'failed' => 'badge-danger',
                                            'pending' => 'badge-warning',
                                            'rate_limited' => 'badge-danger',
                                            'error' => 'badge-secondary',
                                            'timeout' => 'badge-dark',
                                            default => 'badge-light',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $history->status)) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">No messages found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <form method="GET" class="d-flex align-items-center" style="gap: 0.5rem;">
                    <label>Show</label>
                    <select name="per_page" onchange="this.form.submit()" class="filter-control">
                        @foreach([10, 25, 50] as $size)
                            <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                    <span>entries</span>

                    {{-- Kirim filter yang sudah diisi --}}
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="to" value="{{ request('to') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                </form>

                {{-- Pagination --}}
                <div class="pagination overflow-x-auto whitespace-nowrap">
                    <x-pagination :paginator="$histories" />
                </div>
            </div>
        </div>
    </div>
@endsection