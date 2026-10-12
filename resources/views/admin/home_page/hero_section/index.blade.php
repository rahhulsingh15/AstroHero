@extends('admin.layouts.master')
@section('title', 'Hero Section')
@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Data</p>
                <h1 class="h3 mb-1">Hero Section</h1>
            </div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-table" aria-hidden="true"></i>
                    <span>Hero Section List</span>
                </h2>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.hero_section.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Add Hero Section
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
                        <th>Eyebrow / Subtitle</th>
                        <th>Heading</th>
                        <th>Buttons</th>
                        <th>Stats</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($heros as $index => $hero)
                        <tr>
                            <td class="fw-semibold">{{ $index + 1 }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $hero->eyebrow_text ?? 'N/A' }}</span></td>
                            <td style="max-width: 280px;">
                                <div class="fw-semibold text-truncate">{!! strip_tags($hero->heading) !!}</div>
                            </td>
                            <td>
                                <div class="small"><b>Btn 1:</b> {{ $hero->btn1_title ?? '-' }}</div>
                                <div class="small"><b>Btn 2:</b> {{ $hero->btn2_title ?? '-' }}</div>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary">{{ $hero->stat1_value }}</span>
                                <span class="badge bg-info-subtle text-info">{{ $hero->stat2_value }}</span>
                                <span class="badge bg-success-subtle text-success">{{ $hero->stat3_value }}</span>
                            </td>
                            <td>
                                <div class="actions d-flex gap-1">
                                    <a href="{{ route('admin.hero_section.edit', $hero->id) }}" class="btn btn-light btn-sm">Edit</a>
                                    <a href="{{ route('admin.hero_section.delete', $hero->id) }}"
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
    </section>
</div>
@endsection