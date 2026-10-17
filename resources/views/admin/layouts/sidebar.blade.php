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
    <a class="nav-link {{ request()->routeIs('admin.push_notification.*') ? 'active' : '' }}" href="{{ route('admin.push_notification.index') }}">
      <span class="nav-icon"><i class="bi bi-bell" aria-hidden="true"></i></span>
      <span class="nav-text">Push Notifications</span>
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

    <!-- Love Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.love_calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-heart"></i>
                </span>

                <span class="nav-text yyyyold">
                    Love Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.love_calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.love_calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.love_calculator.faq.*') ? 'active' : '' }}" href="{{ route('admin.love_calculator.faq.index') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">FAQs</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.love_calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.love_calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Numerology Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.numerology_calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-123"></i>
                </span>

                <span class="nav-text yyyyold">
                    Numerology Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.numerology_calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.numerology_calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.numerology_calculator.faq.*') ? 'active' : '' }}" href="{{ route('admin.numerology_calculator.faq.index') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">FAQs</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.numerology_calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.numerology_calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>



    <!-- Rising Ascendant Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.rising-ascendant-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-123"></i>
                </span>

                <span class="nav-text yyyyold">
                    Rising Ascendant Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.rising-ascendant-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.rising-ascendant-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.rising-ascendant-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.rising-ascendant-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>


     <!-- Dasha Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.dasha-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-123"></i>
                </span>

                <span class="nav-text yyyyold">
                    Dasha Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.dasha-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.dasha-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.dasha-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.dasha-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Mangal Dosha Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.mangal-dosha-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-fire"></i>
                </span>

                <span class="nav-text yyyyold">
                    Mangal Dosha Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.mangal-dosha-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.mangal-dosha-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.mangal-dosha-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.mangal-dosha-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Moon Phase Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.moon-phase-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-moon-stars"></i>
                </span>

                <span class="nav-text yyyyold">
                    Moon Phase Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.moon-phase-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.moon-phase-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.moon-phase-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.moon-phase-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- FLAMES Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.flames-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-heart-half"></i>
                </span>

                <span class="nav-text yyyyold">
                    FLAMES Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.flames-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.flames-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.flames-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.flames-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Friendship Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.friendship-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span>

                <span class="nav-text yyyyold">
                    Friendship Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.friendship-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.friendship-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.friendship-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.friendship-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Ishta Devata Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.ishta-devata-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-star"></i>
                </span>

                <span class="nav-text yyyyold">
                    Ishta Devata Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.ishta-devata-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.ishta-devata-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.ishta-devata-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.ishta-devata-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Transit Chart Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.transit-chart-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-compass"></i>
                </span>

                <span class="nav-text yyyyold">
                    Transit Chart Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.transit-chart-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.transit-chart-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.transit-chart-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.transit-chart-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Mulank Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.mulank-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-hash"></i>
                </span>

                <span class="nav-text yyyyold">
                    Mulank Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.mulank-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.mulank-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.mulank-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.mulank-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>

    <!-- Age Calculator Page Dropdown -->
    <div class="cms-dropdown {{ request()->routeIs('admin.age-calculator.*') ? 'active' : '' }}">

        <button class="cms-dropdown-btn hytyt" type="button">

            <div class="my_flex">

                <span class="nav-icon">
                    <i class="bi bi-calendar3"></i>
                </span>

                <span class="nav-text yyyyold">
                    Age Calculator
                </span>

            </div>

            <i class="bi bi-chevron-down dropdown-arrow"></i>

        </button>

        <div class="cms-dropdown-menu">

            <a class="nav-link {{ request()->routeIs('admin.age-calculator.content.*') ? 'active' : '' }}" href="{{ route('admin.age-calculator.content.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Page Content</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.age-calculator.report.*') ? 'active' : '' }}" href="{{ route('admin.age-calculator.report.edit') }}">
                <span class="nav-icon"><i class="bi bi-file-earmark"></i></span>
                <span class="nav-text">Report Page</span>
            </a>

        </div>

    </div>
</nav>
</aside>
