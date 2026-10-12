@extends('admin.layouts.master')

@php
$item = $service ?? null;
@endphp
@section('title', isset($item) ? 'Edit Service' : 'Add Service')

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
                    {{ isset($item) ? 'Edit Service' : 'Add Service' }}
                </h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.home_service.index') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Back
            </a>
        </div>
    </div>

    <form class="panel needs-validation"
        action="{{ isset($item) ? route('admin.home_service.update', $item->id) : route('admin.home_service.store') }}"
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
                    {{-- Title --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Service Title <span class="text-danger">*</span></label>
                        <input class="form-control" name="title" type="text"
                            value="{{ old('title', $item->title ?? '') }}"
                            placeholder="Free Kundli" required>
                    </div>

                    {{-- Description --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Description</label>
                        <input class="form-control" name="description" type="text"
                            value="{{ old('description', $item->description ?? '') }}"
                            placeholder="Detailed birth chart in 60 sec">
                    </div>

                    {{-- Icon --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Icon <span class="text-danger">*</span></label>
                        <select class="form-select" name="icon" required>
                            @foreach(config('home_icons') as $key => $icon)
                                <option value="{{ $key }}" @selected(old('icon', $item->icon ?? 'free-kundli') === $key)>
                                    {{ $icon['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Slider Row --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Slider Row <span class="text-danger">*</span></label>
                        <select class="form-select" name="slider_row" required>
                            <option value="1" @selected(old('slider_row', $item->slider_row ?? 1) == 1)>Row 1 (Top, scrolls left)</option>
                            <option value="2" @selected(old('slider_row', $item->slider_row ?? 1) == 2)>Row 2 (Bottom, scrolls right)</option>
                        </select>
                    </div>

                    {{-- Sort Order --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input class="form-control" name="sort_order" type="number" min="0"
                            value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                    </div>

                    {{-- Link --}}
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Link</label>
                        <input class="form-control" name="link" type="text"
                            value="{{ old('link', $item->link ?? '#') }}">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                @checked(old('is_active', $item->is_active ?? 1))>
                            <label class="form-check-label" for="is_active">Show on home page</label>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.home_service.index') }}">Cancel</a>
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
