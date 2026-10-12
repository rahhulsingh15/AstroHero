<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
  <div class="sidebar-header">
    <a class="brand-mark" href="#" aria-label="AstroHero admin dashboard">
      <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
      <span class="brand-copy">
        <span class="brand-title">AstroHero</span>
      </span>
    </a>
  </div>

  <nav class="sidebar-nav">
    <a class="nav-link active" href="{{ route('admin.dashboard') }}" aria-current="page">
      <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
      <span class="nav-text">Dashboard</span>
    </a>
    <a class="nav-link" href="#">
      <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
      <span class="nav-text">Users</span>
    </a>
    <a class="nav-link" href="#"> 
      <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
      <span class="nav-text">Add User</span>
    </a>
    <a class="nav-link" href="#">
      <span class="nav-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
      <span class="nav-text">Settings</span>
    </a>


<!-- Home Page CMS Dropdown -->
        <div class="cms-dropdown {{ request()->routeIs('admin.hero_section.*', 'admin.astrologer_category.*', 'admin.home_service.*') ? 'active' : '' }}">

            <button class="cms-dropdown-btn hytyt" type="button">

                <div class="my_flex">

                    <span class="nav-icon">
                        <i class="bi bi-layout-text-window"></i>
                    </span>

                    <span class="nav-text yyyyold">
                        Home Page
                    </span>

                </div>

                <i class="bi bi-chevron-down dropdown-arrow"></i>

            </button>

            <div class="cms-dropdown-menu">

                <a class="nav-link {{ request()->routeIs('admin.hero_section.*') ? 'active' : '' }}" href="{{ route('admin.hero_section.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-file-earmark"></i>
                    </span>

                    <span class="nav-text">
                        Hero Section
                    </span>

                </a>
                <a class="nav-link {{ request()->routeIs('admin.astrologer_category.*') ? 'active' : '' }}" href="{{ route('admin.astrologer_category.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-file-earmark"></i>
                    </span>

                    <span class="nav-text">
                        Browse by Category
                    </span>

                </a>
                <a class="nav-link {{ request()->routeIs('admin.home_service.*') ? 'active' : '' }}" href="{{ route('admin.home_service.index') }}">

                    <span class="nav-icon">
                        <i class="bi bi-file-earmark"></i>
                    </span>

                    <span class="nav-text">
                        Our Services
                    </span>

                </a>

            </div>

        </div>

    <!-- Chat with Astrologers / Talk to Astrologers Page Dropdowns -->
    @foreach(\App\Models\AstrologerPage::PAGES as $pageSlug => $pageName)
        @php
            $isCurrentPage = request()->routeIs('admin.astrologer_page.*') && request()->route('page') === $pageSlug;
        @endphp
        <div class="cms-dropdown {{ $isCurrentPage ? 'active' : '' }}">

            <button class="cms-dropdown-btn hytyt" type="button">

                <div class="my_flex">

                    <span class="nav-icon">
                        <i class="bi bi-layout-text-window"></i>
                    </span>

                    <span class="nav-text yyyyold">
                        {{ $pageName }} Page
                    </span>

                </div>

                <i class="bi bi-chevron-down dropdown-arrow"></i>

            </button>

            <div class="cms-dropdown-menu">

                <a class="nav-link {{ $isCurrentPage && request()->routeIs('admin.astrologer_page.edit') ? 'active' : '' }}" href="{{ route('admin.astrologer_page.edit', $pageSlug) }}">

                    <span class="nav-icon">
                        <i class="bi bi-file-earmark"></i>
                    </span>

                    <span class="nav-text">
                        Hero Section & Headings
                    </span>

                </a>
                @foreach(\App\Models\AstrologerPageItem::SECTIONS as $sectionKey => $sectionConfig)
                    <a class="nav-link {{ $isCurrentPage && request()->route('section') === $sectionKey ? 'active' : '' }}" href="{{ route('admin.astrologer_page.items.index', [$pageSlug, $sectionKey]) }}">

                        <span class="nav-icon">
                            <i class="bi bi-file-earmark"></i>
                        </span>

                        <span class="nav-text">
                            {{ $sectionConfig['label'] }}
                        </span>

                    </a>
                @endforeach

            </div>

        </div>
    @endforeach
</nav>
</aside>
