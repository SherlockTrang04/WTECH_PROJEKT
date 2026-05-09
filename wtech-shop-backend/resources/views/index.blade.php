<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Elektroshop</title>

</head>
<body>

    <!-- ── NAVBAR ───────────────────────────────────────── -->
    <nav class="navbar main-navbar navbar-expand-lg">
        <div class="container-fluid">

            <!-- Logo -->
            <a class="navbar-brand p-0" href="/">
                <img src="./assets/logo.png" alt="logo" class="logo" />
            </a>

            <!-- Mobile: toggler -->
            <button class="navbar-toggler ms-auto me-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNavCollapse"
                    aria-controls="mainNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible section -->
            <div class="collapse navbar-collapse" id="mainNavCollapse">

                <!-- Search bar - centred -->
                <form method="GET" action="/product_list" class="mx-auto my-2 my-lg-0 d-flex" style="width:100%;max-width:500px;">
                    <input type="text" name="search" placeholder="Hľadať..." class="searchbar" />
                    <button type="submit" class="nav-icon-btn" aria-label="Hľadať">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <!-- Icons -->
                <ul class="navbar-nav align-items-center gap-1 ms-lg-3">
                    <li class="nav-item">
                    <li class="nav-item">
                        <a href="./cart" class="nav-icon-btn" style="text-decoration:none;">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-icon-btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" style="background:transparent;border:none;" href="./user_info">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @auth
                                <li><a class="dropdown-item" href="/user_info">Môj účet</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Odhlásiť sa
                                    </a>
                                </li>
                            @endauth
                            @guest
                                <li><a class="dropdown-item" href="./login">Prihlásiť sa</a></li>
                                <li><a class="dropdown-item" href="./registration">Registrovať sa</a></li>
                            @endguest
                        </ul>
                        @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ── MAIN LAYOUT ──────────────────────────────────── -->
    <div class="d-flex flex-lg-row flex-column" style="flex:1;">

        @php
            $icons = [
                'Notebooky'     => 'fa-laptop',
                'Počítače'      => 'fa-desktop',
                'Smartfóny'     => 'fa-mobile',
                'Príslušenstvo' => 'fa-computer-mouse',
                'Spotrebiče'    => 'fa-blender',
            ];
        @endphp

        <!-- Desktop Sidebar -->
        <aside class="desktop-sidebar sidebar d-none d-lg-block" style="width:200px; flex-shrink:0;">
            <ul class="categories">
                @foreach($categories as $category)
                    @php $icon = $icons[$category->name] ?? 'fa-tag'; @endphp
                    <li>
                        <a href="/product_list?category_id={{ $category->id }}">
                            <i class="fa-solid {{ $icon }}"></i> {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- Mobile Sidebar (Offcanvas) -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Kategórie</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="categories">
                    @foreach($categories as $category)
                        @php $icon = $icons[$category->name] ?? 'fa-tag'; @endphp
                        <li>
                            <a href="/product_list?category_id={{ $category->id }}">
                                <i class="fa-solid {{ $icon }}"></i> {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Content -->
        <main class="content-area flex-grow-1">

            <!-- Mobile: category button -->
            <button class="sidebar-toggle-btn d-lg-none"
                    data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                <i class="fa-solid fa-bars"></i> Kategórie
            </button>

            <!-- Banner -->
            <div class="banner">
                <img src="./assets/banner.png" />
            </div>

            <!-- Products -->
            <p class="section-heading">Odporúčané produkty</p>
            <div class="row g-4 mb-5">
                @foreach($featured as $product)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('product.show', $product) }}" style="text-decoration:none;">
                        <div class="product-card">
                            <img src="{{ $product->images->first()?->url ?? asset('assets/notebook.jpg') }}"
                                 alt="{{ $product->name }}" />
                            <div class="card-body">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->brand }}</p>
                                <span class="price">€{{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </main>
    </div>

    <!-- ── FOOTER ────────────────────────────────────────── -->
    <footer class="main-footer">
        <div class="container">
            <div class="row g-4 justify-content-center text-center text-md-start">
                <div class="col-12 col-md-4">
                    <h4>O nás</h4>
                    <ul>
                        <li><a href="#">Kontakt</a></li>
                        <li><a href="#">Compliance</a></li>
                        <li><a href="#">Kariéra</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4">
                    <h4>Objednávky</h4>
                    <ul>
                        <li><a href="./orderstatus">Stav objednávky</a></li>
                        <li><a href="./rezervationstatus">Stav reklamácie</a></li>
                        <li><a href="#">Ako začať</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4">
                    <h4>Nakupovanie</h4>
                    <ul>
                        <li><a href="#">Obchodné pravidlá</a></li>
                        <li><a href="#">Podmienky reklamácie</a></li>
                        <li><a href="#">Možnosti doručenia</a></li>
                        <li><a href="#">Možnosti platby</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
