<nav class="navbar-principal">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('inicio') }}" class="navbar-brand-custom" id="nav-inicio">
            <span class="brand-icon"><i class="bi bi-box-seam-fill"></i></span>
            MeuEstoque
        </a>
        <div class="d-flex align-items-center gap-1">
            <a href="{{ route('produtos.listar') }}"
               class="nav-link-custom {{ request()->routeIs('produtos.*') || request()->routeIs('inicio') ? 'active' : '' }}"
               id="nav-produtos">
                <i class="bi bi-grid-3x3-gap-fill"></i> Produtos
            </a>
            <a href="{{ route('categorias.listar') }}"
               class="nav-link-custom {{ request()->routeIs('categorias.*') ? 'active' : '' }}"
               id="nav-categorias">
                <i class="bi bi-tags-fill"></i> Categorias
            </a>
        </div>
    </div>
</nav>
