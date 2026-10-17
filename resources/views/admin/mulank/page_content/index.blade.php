@extends('admin.layouts.master')
@section('title', 'Mulank Calculator Page Content')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/4.2.27/es2021/jodit.min.css">
    <style>
        .jodit-wysiwyg table { border-collapse: collapse; width: 100%; }
        .jodit-wysiwyg th,
        .jodit-wysiwyg td { border: 1px solid #ddd; padding: 6px 8px; }
    </style>
@endpush

@section('content')
<div class="container-fluid px-3 px-lg-2 py-4">

    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon">
                <i class="bi bi-hash" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Mulank Calculator Page</p>
                <h1 class="h3 mb-1">Page Content</h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('mulank-calculator') }}" target="_blank">
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> View Page
            </a>
        </div>
    </div>

    <form class="panel needs-validation" action="{{ route('admin.mulank-calculator.content.update') }}"
        method="POST" novalidate>

        @csrf
        @method('PUT')

        <section class="row g-3">
            <div class="col-12 col-xl-12">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                    {{-- Hero --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Hero Banner</h6></div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                        <input class="form-control" name="heading" type="text"
                            value="{{ old('heading', $content->heading ?? '') }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3">{{ old('description', $content->description ?? '') }}</textarea>
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Main content --}}
                    <div class="col-12">
                        <h6 class="text-primary mb-1">Main Content</h6>
                    </div>
                    <div class="col-12 mb-3">
                        <textarea class="form-control jodit-editor" name="main_content" rows="14">{{ old('main_content', $content->main_content ?? '') }}</textarea>
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- FAQ --}}
                    <div class="col-12"><h6 class="text-primary mb-2">FAQ Section</h6></div>
                    <div class="col-12 mb-3">
                        <textarea class="form-control jodit-editor" name="faq_content" rows="8">{{ old('faq_content', $content->faq_content ?? '') }}</textarea>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-circle me-1"></i> Update
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
                height: 520,
                toolbarAdaptive: false,
                uploader: { insertImageAsBase64URI: true },
                askBeforePasteHTML: false,
                askBeforePasteFromWord: false
            });
        });
    </script>
@endpush
