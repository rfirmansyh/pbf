<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-secondary py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">FBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('home*') || Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home.index') }}"><i class="fas fa-newspaper mr-2"></i> Beranda</a>
                </li>
                <li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.index') }}"><i class="fas fa-cog mr-2"></i> Olah Blog</a>
                </li>
            </ul>
        </div>
    </div>
</nav>