@extends('admin.layouts.master')

@php
$item = $hero ?? null;
@endphp
@section('title', isset($item) ? 'Edit Hero section' : 'Add Hero section')

@section('content')
<div class="container-fluid px-3 px-lg-2 py-4">

    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon">
                <i class="bi bi-person-fill-gear" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Management</p>
                <h1 class="h3 mb-1">
                    {{ isset($item) ? 'Edit Hero section' : 'Add Hero section' }}
                </h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.hero_section.index') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Back
            </a>
        </div>
    </div>

    <form class="panel needs-validation"
        action="{{ isset($item) ? route('admin.hero_section.update', $item->id) : route('admin.hero_section.store') }}"
        method="POST" novalidate>

        @csrf
        @if(isset($item))
            @method('PUT')
        @endif

        <section class="row g-3">
            <div class="col-12 col-xl-12">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    {{-- Eyebrow Text --}}
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Eyebrow Text</label>
                        <input class="form-control" name="eyebrow_text" type="text"
                            value="{{ old('eyebrow_text', $item->eyebrow_text ?? '') }}"
                        >
                    </div>

                    {{-- Match Score --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kundli Match Score (/36)</label>
                        <input class="form-control" name="match_score" type="number" min="1" max="36"
                            value="{{ old('match_score', $item->match_score ?? '') }}">
                    </div>

                    {{-- Main Heading --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Main Heading <span class="text-danger">*</span></label>
                        <input class="form-control" name="heading" type="text"
                            value="{{ old('heading', $item->heading ?? '') }}"
                             required>
                    </div>

                    {{-- Subheading Lead Text --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Lead Subtitle</label>
                        <textarea class="form-control" name="lead_text" rows="3"
                            placeholder="Description text...">{{ old('lead_text', $item->lead_text ?? '') }}</textarea>
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Button 1 --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Primary Button</h6></div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 Title</label>
                        <input class="form-control" name="btn1_title" type="text"
                            value="{{ old('btn1_title', $item->btn1_title ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 Link</label>
                        <input class="form-control" name="btn1_link" type="text"
                            value="{{ old('btn1_link', $item->btn1_link ?? '#') }}">
                    </div>

                    {{-- Button 2 --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Secondary Button</h6></div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 Title</label>
                        <input class="form-control" name="btn2_title" type="text"
                            value="{{ old('btn2_title', $item->btn2_title ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 Link</label>
                        <input class="form-control" name="btn2_link" type="text"
                            value="{{ old('btn2_link', $item->btn2_link ?? '#') }}">
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Stats --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Statistics Counter</h6></div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stat 1 Value</label>
                        <input class="form-control mb-1" name="stat1_value" type="text"
                            value="{{ old('stat1_value', $item->stat1_value ?? '') }}">
                        <label class="form-label small text-muted">Stat 1 Label</label>
                        <input class="form-control" name="stat1_label" type="text"
                            value="{{ old('stat1_label', $item->stat1_label ?? '') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stat 2 Value</label>
                        <input class="form-control mb-1" name="stat2_value" type="text"
                            value="{{ old('stat2_value', $item->stat2_value ?? '') }}">
                        <label class="form-label small text-muted">Stat 2 Label</label>
                        <input class="form-control" name="stat2_label" type="text"
                            value="{{ old('stat2_label', $item->stat2_label ?? '') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stat 3 Value</label>
                        <input class="form-control mb-1" name="stat3_value" type="text"
                            value="{{ old('stat3_value', $item->stat3_value ?? '') }}">
                        <label class="form-label small text-muted">Stat 3 Label</label>
                        <input class="form-control" name="stat3_label" type="text"
                            value="{{ old('stat3_label', $item->stat3_label ?? '') }}">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.hero_section.index') }}">Cancel</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ isset($item) ? 'Update' : 'Add' }}
                    </button>
                </div>

            </div>
        </section>
    </form>
</div>
@endsection