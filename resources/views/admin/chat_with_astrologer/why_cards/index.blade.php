@extends('admin.layouts.master')
@section('title', 'Why AstroHero Cards')
@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Chat with Astrologers Page</p>
                <h1 class="h3 mb-1">Why AstroHero Cards</h1>
            </div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-table" aria-hidden="true"></i>
                    <span>Card List</span>
                </h2>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.astrologer_page.items.create', ['chat', 'feature']) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Add Card
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
                        <th>Icon</th>
                        <th>Card Title</th>
                        <th>Card Text</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                        <tr>
                            <td class="fw-semibold">{{ $items->firstItem() + $index }}</td>
                            <td>
                                @include('frontend.partials.home-icon', ['icon' => $item->icon, 'size' => 22, 'stroke' => 2])
                            </td>
                            <td class="fw-semibold">{{ $item->title }}</td>
                            <td style="max-width: 380px;">
                                <div class="small text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 110) }}</div>
                            </td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success-subtle text-success">Active</span>
                                @else
                                    <span class="badge bg-light text-dark border">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions d-flex gap-1">
                                    <a href="{{ route('admin.astrologer_page.items.edit', ['chat', 'feature', $item->id]) }}" class="btn btn-light btn-sm">Edit</a>
                                    <a href="{{ route('admin.astrologer_page.items.delete', ['chat', 'feature', $item->id]) }}"
                                       onclick="return confirm('Are you sure you want to delete this record?')"
                                       class="btn btn-light btn-sm text-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $items->links() }}
        </div>
    </section>
</div>
@endsection
