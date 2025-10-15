<nav id="navigation">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="logo">
            </div>
            <span class="nav-logo-text">MIS Alumni</span>
        </a>


        <ul class="nav-menu" id="navMenu">
            @foreach ($activeMenus as $menu)
                <li>
                    <a href="{{ url($menu->url) }}"
                        class="{{ ($menu->url === '/' && request()->is('/')) || request()->is(ltrim($menu->url, '/')) ? 'active' : '' }}">
                        {{ $menu->name }}
                    </a>
                </li>
            @endforeach
            <li class="nav-cta">
                <button class="btn btn-primary">Join Network</button>
            </li>
        </ul>


        <button class="nav-toggle" id="navToggle">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12h18M3 6h18M3 18h18"></path>
            </svg>
        </button>
    </div>
</nav>
