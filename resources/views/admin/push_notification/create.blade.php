@extends('admin.layouts.master')
@section('title', 'Send Notification')

@section('content')
<div class="container-fluid px-3 px-lg-2 py-4">

    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon">
                <i class="bi bi-send" aria-hidden="true"></i>
            </span>
            <div>
                <p class="eyebrow mb-1">Firebase</p>
                <h1 class="h3 mb-1">Send Notification</h1>
            </div>
        </div>

        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.push_notification.index') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Back
            </a>
        </div>
    </div>

    <form class="panel needs-validation" action="{{ route('admin.push_notification.store') }}" method="POST" novalidate
        onsubmit="return confirm('Send this notification to {{ $subscriberCount }} subscriber(s)?')">
        @csrf

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

                <div class="alert alert-info">
                    <i class="bi bi-people me-1"></i>
                    This notification will go to <strong>{{ $subscriberCount }}</strong> subscriber(s).
                </div>

                <div class="row">
                    {{-- Title --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control" name="title" type="text" maxlength="100"
                            value="{{ old('title') }}" placeholder="Aaj ka Rashifal ✨" required>
                    </div>

                    {{-- Link --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Link (click par khulega)</label>
                        <input class="form-control" name="link" type="url"
                            value="{{ old('link', url('/')) }}" placeholder="{{ url('/') }}">
                    </div>

                    {{-- Message --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="body" rows="3" maxlength="250"
                            placeholder="Apna aaj ka horoscope padhiye..." required>{{ old('body') }}</textarea>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.push_notification.index') }}">Cancel</a>
                    <button class="btn btn-primary" type="submit" @disabled($subscriberCount === 0)>
                        <i class="bi bi-send me-1"></i> Send
                    </button>
                </div>

            </div>
        </section>
    </form>
</div>
@endsection
