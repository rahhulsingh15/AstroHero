<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="AstroHero admin login">
  <title>Admin Login | AstroHero</title>
  <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
</head>
<body class="auth-body">
  <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
    <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
  </button>
  <main class="auth-page">
    <section class="auth-card">
        <form class="needs-validation" novalidate    action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                <p class="eyebrow mb-1">Secure Access</p>
                <h1 class="h3 mb-1">Admin  Login</h1>
                <p class="text-muted mb-0">Sign in to your admin workspace.</p>
                </div>
                @if($errors->any())
                    <div style="color: red;">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%;">
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Password</label>
                    </div>
                    <input type="password" name="password" required style="width: 100%;">
                </div>            
                    <button class="btn btn-primary w-100" type="submit" style="width: 100%; padding: 8px;">Login</button>        
        </form>
    </section>
  </main>

  <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/main.js') }}"></script>
</body>
</html>
