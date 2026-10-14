@extends('admin.layouts.master')

@php
$item = $faq ?? null;
@endphp
@section('title', isset($item) ? 'Edit FAQ' : 'Add FAQ')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/4.2.27/es2021/jodit.min.css">
@endpush

@section('content')
<div class="container-fluid px-3 px-lg-2 py-4">

    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon">
                <i class="bi bi-heart" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Love Calculator Page</p>
                <h1 class="h3 mb-1">
                    {{ isset($item) ? 'Edit FAQ' : 'Add FAQ' }}
                </h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.love_calculator.faq.index') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Back
            </a>
        </div>
    </div>

    <form class="panel needs-validation"
        action="{{ isset($item) ? route('admin.love_calculator.faq.update', $item->id) : route('admin.love_calculator.faq.store') }}"
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
                    {{-- Question --}}
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Question <span class="text-danger">*</span></label>
                        <input class="form-control" name="question" type="text"
                            value="{{ old('question', $item->question ?? '') }}" required>
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

                    {{-- Answer --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                        <textarea class="form-control jodit-editor" name="answer" rows="6">{{ old('answer', $item->answer ?? '') }}</textarea>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.love_calculator.faq.index') }}">Cancel</a>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/4.2.27/es2021/jodit.min.js"></script>
    <script>
        document.querySelectorAll('.jodit-editor').forEach(function (el) {
            Jodit.make(el, {
                height: 280,
                toolbarAdaptive: false,
                askBeforePasteHTML: false,
                askBeforePasteFromWord: false
            });
        });
    </script>
@endpush
