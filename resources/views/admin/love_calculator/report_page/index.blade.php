@extends('admin.layouts.master')
@section('title', 'Love Report Page')

@section('content')
<div class="container-fluid px-3 px-lg-2 py-4">

    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon">
                <i class="bi bi-heart" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Love Calculator Page</p>
                <h1 class="h3 mb-1">Report Page</h1>
            </div>
        </div>
    </div>

    <form class="panel needs-validation" action="{{ route('admin.love_calculator.report.update') }}"
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
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Browser Tab Title</label>
                        <input class="form-control" name="report_meta_title" type="text"
                            value="{{ old('report_meta_title', $content->report_meta_title) }}">
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Banner --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Chat Banner</h6></div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tag</label>
                        <input class="form-control" name="report_banner_tag" type="text"
                            value="{{ old('report_banner_tag', $content->report_banner_tag) }}" placeholder="LIMITED-TIME OFFER">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Heading</label>
                        <input class="form-control" name="report_banner_title" type="text"
                            value="{{ old('report_banner_title', $content->report_banner_title) }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Text</label>
                        <textarea class="form-control" name="report_banner_text" rows="3">{{ old('report_banner_text', $content->report_banner_text) }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text</label>
                        <input class="form-control" name="report_banner_button" type="text"
                            value="{{ old('report_banner_button', $content->report_banner_button) }}">
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Experts --}}
                    <div class="col-12"><h6 class="text-primary mb-2">Astrologers Section</h6></div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input class="form-control" name="report_experts_title" type="text"
                            value="{{ old('report_experts_title', $content->report_experts_title) }}" placeholder="Talk to Love Experts">
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
