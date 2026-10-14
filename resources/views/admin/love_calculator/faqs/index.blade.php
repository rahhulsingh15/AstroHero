@extends('admin.layouts.master')
@section('title', 'Love Calculator FAQs')
@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Love Calculator Page</p>
                <h1 class="h3 mb-1">FAQs</h1>
            </div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-table" aria-hidden="true"></i>
                    <span>FAQ List</span>
                </h2>
            </div>
            <div class="d-flex align-items-center gap-2">
                <form method="GET" action="{{ route('admin.love_calculator.faq.index') }}" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search question..."
                        value="{{ $search }}">
                </form>
                <a href="{{ route('admin.love_calculator.faq.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Add FAQ
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
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $index => $faq)
                        <tr>
                            <td class="fw-semibold">{{ $faqs->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $faq->question }}</td>
                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($faq->answer), 80) }}</td>
                            <td>
                                @if($faq->is_active)
                                    <span class="badge bg-success-subtle text-success">Active</span>
                                @else
                                    <span class="badge bg-light text-dark border">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions d-flex gap-1">
                                    <a href="{{ route('admin.love_calculator.faq.edit', $faq->id) }}" class="btn btn-light btn-sm">Edit</a>
                                    <a href="{{ route('admin.love_calculator.faq.delete', $faq->id) }}"
                                       onclick="return confirm('Are you sure you want to delete this record?')"
                                       class="btn btn-light btn-sm text-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $faqs->links() }}
        </div>
    </section>
</div>
@endsection
