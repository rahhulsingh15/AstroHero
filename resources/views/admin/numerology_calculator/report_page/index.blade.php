@extends('admin.layouts.master')
@section('title', 'Numerology Report Page')

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
                <i class="bi bi-123" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Numerology Calculator Page</p>
                <h1 class="h3 mb-1">Report Page</h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('numerology-report', ['name' => 'Anjali', 'system' => 'chaldean']) }}" target="_blank">
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> View Sample Report
            </a>
        </div>
    </div>

    <form class="panel needs-validation" action="{{ route('admin.numerology_calculator.report.update') }}"
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
                    {{-- Banner --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Chat / Call Banner</h6></div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input class="form-control" name="report_banner_title" type="text"
                            value="{{ old('report_banner_title', $content->report_banner_title) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Text</label>
                        <input class="form-control" name="report_banner_text" type="text"
                            value="{{ old('report_banner_text', $content->report_banner_text) }}">
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Content --}}
                    <div class="col-12">
                        <h6 class="text-primary mb-1">Content (banner ke neeche)</h6>
                        <p class="form-text mt-0 mb-2">"The Power of Name Numerology", Chaldean chart table aur "Should you change your name spelling?" yahin hain.</p>
                    </div>
                    <div class="col-12 mb-3">
                        <textarea class="form-control jodit-editor" name="report_content" rows="12">{{ old('report_content', $content->report_content) }}</textarea>
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
                height: 420,
                toolbarAdaptive: false,
                uploader: { insertImageAsBase64URI: true },
                askBeforePasteHTML: false,
                askBeforePasteFromWord: false
            });
        });
    </script>
@endpush
