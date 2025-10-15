<nav id="navigation">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="logo">
            </div>
            <span class="nav-logo-text">MIS Alumni</span>
        </a>


        <ul class="nav-menu" id="navMenu"
            style="display: flex; align-items: center; list-style: none; margin: 0; padding: 0;">
            @foreach ($activeMenus as $menu)
                <li style="margin: 0 0.75rem;">
                    <a href="{{ url($menu->url) }}"
                        class="{{ ($menu->url === '/' && request()->is('/')) || request()->is(ltrim($menu->url, '/')) ? 'active' : '' }}"
                        style="text-decoration: none; color: inherit;">
                        {{ $menu->name }}
                    </a>
                </li>
            @endforeach
            <li class="nav-cta" style="margin-left: 1rem; display: flex; align-items: center;">
                <button class="btn btn-primary" style="padding: 0.5rem 1rem; vertical-align: middle; margin: 0;">
                    Join Network
                </button>
            </li>
        </ul>



        <button class="nav-toggle" id="navToggle">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12h18M3 6h18M3 18h18"></path>
            </svg>
        </button>
    </div>
</nav>
