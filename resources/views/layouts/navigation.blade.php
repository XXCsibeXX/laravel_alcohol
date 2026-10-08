<nav class="main-nav" id="main-nav">
    <a href="{{ route('home') }}" @class(['nav-link', 'active' => request()->routeIs('home')])>
        <x-icon name="home" /> Kezdőlap
    </a>
    <a href="{{ route('categories.index') }}" @class(['nav-link', 'active' => request()->routeIs('categories.*')])>
        <x-icon name="tag" /> Kategóriák
    </a>
    <a href="{{ route('products.index') }}" @class(['nav-link', 'active' => request()->routeIs('products.*')])>
        <x-icon name="wine" /> Termékek
    </a>
</nav>
