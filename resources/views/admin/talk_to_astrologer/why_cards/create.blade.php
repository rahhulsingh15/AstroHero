@extends('admin.layouts.master')
@section('title', isset($item) ? 'Edit Card' : 'Add Card')

@section('content')
<div class="container-fluid px-3 px-lg-2 py-4">

    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon">
                <i class="bi bi-person-fill-gear" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Talk to Astrologers Page &middot; Why AstroHero Cards</p>
                <h1 class="h3 mb-1">
                    {{ isset($item) ? 'Edit Card' : 'Add Card' }}
                </h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.astrologer_page.items.index', ['talk', 'feature']) }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Back
            </a>
        </div>
    </div>

    <form class="panel needs-validation"
        action="{{ isset($item) ? route('admin.astrologer_page.items.update', ['talk', 'feature', $item->id]) : route('admin.astrologer_page.items.store', ['talk', 'feature']) }}"
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
                    {{-- Card Title --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Card Title <span class="text-danger">*</span></label>
                        <input class="form-control" name="title" type="text"
                            value="{{ old('title', $item->title ?? '') }}" required>
                    </div>

                    {{-- Card Text --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Card Text</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $item->description ?? '') }}</textarea>
                        <div class="form-text">
                            Bold text ke liye <code>&lt;strong&gt;...&lt;/strong&gt;</code> likh sakte ho.
                        </div>
                    </div>

                    {{-- Icon --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Icon <span class="text-danger">*</span></label>
                        <select class="form-select" name="icon" required>
                            @foreach(config('home_icons') as $key => $icon)
                                <option value="{{ $key }}" @selected(old('icon', $item->icon ?? 'star') === $key)>
                                    {{ $icon['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sort Order --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input class="form-control" name="sort_order" type="number" min="0"
                            value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                @checked(old('is_active', $item->is_active ?? 1))>
                            <label class="form-check-label" for="is_active">Show on page</label>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.astrologer_page.items.index', ['talk', 'feature']) }}">Cancel</a>
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
