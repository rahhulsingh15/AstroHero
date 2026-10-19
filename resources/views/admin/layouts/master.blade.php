<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AstroHero admin panel">
    <title>Dashboard | AstroHero Admin</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}?v={{ @filemtime(public_path('admin/assets/css/style.css')) ?: time() }}">
    @stack('styles')
</head>
<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>
        @include('admin.layouts.sidebar')

        <div class="admin-main">
            @include('admin.layouts.header')

            <main class="dashboard-content">
                @yield('content')
            </main>
        </div>
    </div>
@include('admin.layouts.scripts')
@stack('scripts')
</body>

</html>