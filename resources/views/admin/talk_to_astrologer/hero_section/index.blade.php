@extends('admin.layouts.master')
@section('title', 'Hero Section & Headings')

@section('content')
<div class="container-fluid px-3 px-lg-2 py-4">

    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon">
                <i class="bi bi-person-fill-gear" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Talk to Astrologers Page</p>
                <h1 class="h3 mb-1">Hero Section & Headings</h1>
            </div>
        </div>
    </div>

    <form class="panel needs-validation" action="{{ route('admin.astrologer_page.update', 'talk') }}"
        method="POST" enctype="multipart/form-data" novalidate>

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
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Breadcrumb Label</label>
                        <input class="form-control" name="breadcrumb_label" type="text"
                            value="{{ old('breadcrumb_label', $content->breadcrumb_label ?? '') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Main Heading <span class="text-danger">*</span></label>
                        <input class="form-control" name="hero_title" type="text"
                            value="{{ old('hero_title', $content->hero_title ?? '') }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="hero_description" rows="4">{{ old('hero_description', $content->hero_description ?? '') }}</textarea>
                        <div class="form-text">Bold text ke liye <code>&lt;strong&gt;24*7&lt;/strong&gt;</code> likh sakte ho.</div>
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Hero right side widget --}}
                    <div class="col-12">
                        <h6 class="text-primary mb-2">Hero Right Side (Calling Widget)</h6>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Astrologer Name</label>
                        <input class="form-control" name="hero_astrologer_name" type="text"
                            value="{{ old('hero_astrologer_name', $content->hero_astrologer_name ?? '') }}">
                        <div class="form-text">Khaali chhodoge to widget nahi dikhega.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status Text</label>
                        <input class="form-control" name="hero_status_text" type="text"
                            value="{{ old('hero_status_text', $content->hero_status_text ?? '') }}"
                            placeholder="Calling">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Call Timer</label>
                        <input class="form-control" name="hero_pill_text" type="text"
                            value="{{ old('hero_pill_text', $content->hero_pill_text ?? '') }}"
                            placeholder="06:54">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Astrologer Photo</label>
                        <input class="form-control" name="hero_astrologer_image" type="file" accept="image/*">
                        @if($content)
                            <div class="mt-3">
                                <img src="{{ $content->heroImageUrl() }}" alt="" width="70" height="70"
                                    style="border-radius: 50%; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Why section --}}
                    <div class="col-12"><h6 class="text-primary mb-2">"Why AstroHero" Section</h6></div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cards Heading</label>
                        <input class="form-control" name="why_title" type="text"
                            value="{{ old('why_title', $content->why_title ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Verify Steps Heading</label>
                        <input class="form-control" name="verify_title" type="text"
                            value="{{ old('verify_title', $content->verify_title ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Verify Steps Badge</label>
                        <input class="form-control" name="verify_badge" type="text"
                            value="{{ old('verify_badge', $content->verify_badge ?? '') }}">
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="form-label">Connect Box Heading</label>
                        <input class="form-control" name="connect_title" type="text"
                            value="{{ old('connect_title', $content->connect_title ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Popular Topics Heading</label>
                        <input class="form-control" name="topics_title" type="text"
                            value="{{ old('topics_title', $content->topics_title ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Connect Box Text</label>
                        <textarea class="form-control" name="connect_description" rows="7">{{ old('connect_description', $content->connect_description ?? '') }}</textarea>
                        <div class="form-text">Naya paragraph shuru karne ke liye beech mein ek khaali line chhodo.</div>
                    </div>

                    <div class="col-12"><hr class="my-2"></div>

                    {{-- Services tabs section --}}
                    <div class="col-12"><h6 class="text-primary mb-2">"Explore Services" Section</h6></div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Heading</label>
                        <input class="form-control" name="services_title" type="text"
                            value="{{ old('services_title', $content->services_title ?? '') }}">
                    </div>
                    <div class="col-md-7 mb-3">
                        <label class="form-label">Subtitle</label>
                        <input class="form-control" name="services_subtitle" type="text"
                            value="{{ old('services_subtitle', $content->services_subtitle ?? '') }}">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-circle me-1"></i>
                        Update
                    </button>
                </div>

            </div>
        </section>
    </form>
</div>
@endsection
