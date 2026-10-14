@extends('admin.layouts.master')
@section('title', 'Push Notifications')
@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-bell" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Firebase</p>
                <h1 class="h3 mb-1">Push Notifications</h1>
            </div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-table" aria-hidden="true"></i>
                    <span>Sent Notifications</span>
                </h2>
                <p class="text-muted small mb-0">Active subscribers: <strong>{{ $subscriberCount }}</strong></p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.push_notification.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-send"></i> Send Notification
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Link</th>
                        <th>Sent</th>
                        <th>Failed</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $index => $notification)
                        <tr>
                            <td class="fw-semibold">{{ $notifications->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $notification->title }}</td>
                            <td>{{ $notification->body }}</td>
                            <td>{{ $notification->link ?? '-' }}</td>
                            <td><span class="badge bg-success-subtle text-success">{{ $notification->sent_count }}</span></td>
                            <td><span class="badge bg-light text-dark border">{{ $notification->failed_count }}</span></td>
                            <td>{{ $notification->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="actions d-flex gap-1">
                                    <a href="{{ route('admin.push_notification.delete', $notification->id) }}"
                                       onclick="return confirm('Are you sure you want to delete this record?')"
                                       class="btn btn-light btn-sm text-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No notifications sent yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $notifications->links() }}
        </div>
    </section>
</div>
@endsection
