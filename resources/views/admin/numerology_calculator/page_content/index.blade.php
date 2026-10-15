@extends('admin.layouts.master')
@section('title', 'Numerology Calculator Page Content')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/4.2.27/es2021/jodit.min.css">
    <style>
        /* Editor ke andar tables ki lines dikhein */
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
                <i class="bi bi-123" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Numerology Calculator Page</p>
                <h1 class="h3 mb-1">Page Content</h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('numerology-calculator') }}" target="_blank">
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> View Page
            </a>
        </div>
    </div>

    <form class="panel needs-validation" action="{{ route('admin.numerology_calculator.content.update') }}"
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
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Browser Tab Title</label>
                        <input class="form-control" name="meta_title" type="text"
                            value="{{ old('meta_title', $content->meta_title) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Breadcrumb Label</label>
                        <input class="form-control" name="breadcrumb_label" type="text"
                            value="{{ old('breadcrumb_label', $content->breadcrumb_label) }}" placeholder="NAME NUMEROLOGY CALCULATOR">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Main Heading <span class="text-danger">*</span></label>
                        <input class="form-control" name="hero_title" type="text"
                            value="{{ old('hero_title', $content->hero_title) }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="hero_intro" rows="3">{{ old('hero_intro', $content->hero_intro) }}</textarea>
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Form + promo --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Calculator Form &amp; Astrologer Banner</h6></div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Form Heading</label>
                        <input class="form-control" name="form_title" type="text"
                            value="{{ old('form_title', $content->form_title) }}" placeholder="Enter Your Details">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Call / Chat Banner Text</label>
                        <input class="form-control" name="promo_text" type="text"
                            value="{{ old('promo_text', $content->promo_text) }}">
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Main content --}}
                    <div class="col-12">
                        <h6 class="text-primary mb-1">Main Content (banner ke neeche)</h6>
                        <p class="form-text mt-0 mb-2">"What Is Name Numerology?" se lekar "How Does the Name Numerology Calculator Work?" tak sab yahin hai, tables samet. "Discover More" cards apne aap neeche dikhte hain.</p>
                    </div>
                    <div class="col-12 mb-3">
                        <textarea class="form-control jodit-editor" name="main_content" rows="14">{{ old('main_content', $content->main_content) }}</textarea>
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- FAQ --}}
                    <div class="col-12"><h6 class="text-primary mb-2">FAQ Section Heading</h6></div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Small Heading</label>
                        <input class="form-control" name="faq_subtitle" type="text"
                            value="{{ old('faq_subtitle', $content->faq_subtitle) }}" placeholder="FREQUENTLY ASKED">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Main Heading</label>
                        <input class="form-control" name="faq_title" type="text"
                            value="{{ old('faq_title', $content->faq_title) }}">
                        <div class="form-text">Rangeen word ke liye <code>&lt;span class="highlight"&gt;Find&lt;/span&gt;</code>, nayi line ke liye <code>&lt;br&gt;</code>.</div>
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
        // Har .jodit-editor textarea ko Jodit editor bana do
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
