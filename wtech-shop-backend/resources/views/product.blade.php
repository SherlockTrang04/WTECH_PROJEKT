<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200..1000&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">   
    <title>Produkt</title>

</head>
<body>
    <!-- ── NAVBAR ───────────────────────────────────────── -->
    <nav class="navbar main-navbar navbar-expand-lg">
        <div class="container-fluid">

            <!-- Logo -->
            <a class="navbar-brand p-0" href="/">
                <img src="/assets/logo.png" alt="logo" class="logo" />
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
                <div class="mx-auto my-2 my-lg-0" style="width:100%;max-width:500px;">
                    <input type="text" placeholder="Hľadať..." class="searchbar" />
                </div>

                <!-- Icons -->
                <ul class="navbar-nav align-items-center gap-1 ms-lg-3">
                    <li class="nav-item">
                        <button class="nav-icon-btn" aria-label="Hľadať">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="/cart" class="nav-icon-btn" style="text-decoration:none;">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-icon-btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" style="background:transparent;border:none;">
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
                                <li><a class="dropdown-item" href="/login">Prihlásiť sa</a></li>
                                <li><a class="dropdown-item" href="/registration">Registrovať sa</a></li>
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

        <!-- Desktop Sidebar -->
        <aside class="sidebar d-none d-lg-block" style="width:200px; flex-shrink:0;">
            <ul class="categories">
                <li><a href="#"><i class="fa-solid fa-star"></i> Novinky</a></li>
                <li><a href="#"><i class="fa-solid fa-laptop"></i> Notebooky</a></li>
                <li><a href="#"><i class="fa-solid fa-desktop"></i> Počítače</a></li>
                <li><a href="#"><i class="fa-solid fa-mobile"></i> Smartfóny</a></li>
                <li><a href="#"><i class="fa-solid fa-computer-mouse"></i> Príslušenstvá</a></li>
                <li><a href="#"><i class="fa-solid fa-blender"></i> Spotrebiče</a></li>
            </ul>
        </aside>

        <!-- Mobile Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Kategórie</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="categories">
                    <li><a href="#"><i class="fa-solid fa-star"></i> Novinky</a></li>
                    <li><a href="#"><i class="fa-solid fa-laptop"></i> Notebooky</a></li>
                    <li><a href="#"><i class="fa-solid fa-desktop"></i> Počítače</a></li>
                    <li><a href="#"><i class="fa-solid fa-mobile"></i> Smartfóny</a></li>
                    <li><a href="#"><i class="fa-solid fa-computer-mouse"></i> Príslušenstvá</a></li>
                    <li><a href="#"><i class="fa-solid fa-blender"></i> Spotrebiče</a></li>
                </ul>
            </div>
        </div>


    <div class="content-area flex-grow-1">
        <div class="product-detail">
            <div class="product-gallery">
<<<<<<< HEAD
                <button class="gallery-btn prev-btn" id="prev-btn">&#8249;</button>
                <img id="main-image" src="{{ $product->images->first()->url ?? 'https://placehold.co/400x400' }}" alt="product" class="gallery-img"/>
                <button class="gallery-btn next-btn" id="next-btn">&#8250;</button>
            </div>

            <div class="product-thumbnails">
                @foreach($product->images as $index => $image)
                    <img src="{{ $image->url }}" alt="thumbnail" class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="changeImage('{{ $image->url }}')">
                @endforeach
            </div>

            <div class="product-info">
                <p class="product-info-label">{{ $product->name }}</p>
                <p class="product-info-description">{{ $product->description }}</p>
                <p class="product-price">€{{ number_format($product->price, 2) }}</p>
=======
                <button type="button" class="gallery-btn prev-btn">&#8249;</button>
                <img id="galleryImg"
                     src="{{ $product->images->first()?->url ?? asset('assets/placeholder.jpg') }}"
                     alt="{{ $product->name }}" class="gallery-img"/>
                <button type="button" class="gallery-btn next-btn">&#8250;</button>
            </div>

            <script>
                const productImages = @json($product->images->pluck('url'));
            </script>
>>>>>>> efa068c0ce0df8696bb8b69393a6fc818b3d515c

            <div class="product-info">
                <p class="product-info-label">{{ strtoupper($product->brand) }}</p>
                <h2>{{ $product->name }}</h2>
                <p class="product-info-description">{{ $product->description }}</p>
                <p class="product-price">€{{ number_format($product->price, 2) }}</p>

                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="product-quantity">
                        <button type="button" class="qty-btn" onclick="changeQty(-1)">&#8722;</button>
                        <input type="number" id="qty" name="quantity" value="1" min="1" max="99"
                               class="qty-input" oninput="validateQty(this)"/>
                        <button type="button" class="qty-btn" onclick="changeQty(+1)">&#43;</button>
                        <span class="qty-err" id="qty-err"></span>
                    </div>
                    <button type="submit" class="add-to-cart-btn">Do košíka</button>
                </form>

                <script>
<<<<<<< HEAD
                    let currentImageIndex = 0;
                    const images = @json($product->images->pluck('url')->toArray());

                    function changeImage(url) {
                        document.getElementById('main-image').src = url;
                        currentImageIndex = images.indexOf(url);
                        // Update active thumbnail
                        document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
                            thumb.classList.toggle('active', index === currentImageIndex);
                        });
                    }

                    document.getElementById('prev-btn').addEventListener('click', function() {
                        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                        changeImage(images[currentImageIndex]);
                    });

                    document.getElementById('next-btn').addEventListener('click', function() {
                        currentImageIndex = (currentImageIndex + 1) % images.length;
                        changeImage(images[currentImageIndex]);
                    });

                    function changeQty(qty) {
=======
                    function changeQty(delta) {
>>>>>>> efa068c0ce0df8696bb8b69393a6fc818b3d515c
                        const input = document.getElementById('qty');
                        let current = parseInt(input.value) || 1;
                        current += delta;
                        if (current < 1) current = 1;
                        if (current > 99) current = 99;
                        input.value = current;
                        document.getElementById('qty-err').textContent = '';
                    }

                    function validateQty(input) {
                        const error = document.getElementById('qty-err');
                        const value = input.value;
                        if (value === '' || isNaN(value)) {
                            error.textContent = 'Zadajte platné číslo';
                        } else if (parseInt(value) < 1) {
                            error.textContent = 'Množstvo musí byť aspoň 1';
                            input.value = 1;
                        } else if (parseInt(value) > 99) {
                            error.textContent = 'Množstvo nemôže byť viac ako 99';
                            input.value = 99;
                        } else if (!Number.isInteger(parseFloat(value))) {
                            error.textContent = 'Zadajte celé číslo';
                            input.value = Math.floor(value);
                        } else {
                            error.textContent = '';
                        }
                    }
                </script>
            </div>
        </div>

        <div class="product-params">
            <h2>Parametre:</h2>
            <ul>
                <li><strong>Značka:</strong> {{ $product->brand }}</li>
                <li><strong>Farba:</strong> {{ $product->color }}</li>
                <li><strong>Hodnotenie:</strong> {{ $product->stars }} / 5</li>
                <li><strong>Skladom:</strong> {{ $product->stock }} ks</li>
            </ul>
        </div>

        <div class="similar-products">
            <h2>Podobné produkty:</h2>
            <div class="similar-row">
                @foreach($similar as $item)
                    <a href="{{ route('product.show', $item) }}" style="text-decoration:none;">
                        <div class="product">
                            <img src="{{ $item->images->first()?->url ?? asset('assets/placeholder.jpg') }}"
                                 alt="{{ $item->name }}"/>
                            <p>{{ $item->name }}</p>
                            <span class="price">€{{ number_format($item->price, 2) }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
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
                        <li><a href="#">Stav objednávky</a></li>
                        <li><a href="#">Stav reklamácie</a></li>
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
    <script>
        let imgIndex = 0;
        const galleryImg = document.getElementById('galleryImg');

        document.querySelector('.prev-btn').addEventListener('click', () => {
            if (productImages.length === 0) return;
            imgIndex = (imgIndex - 1 + productImages.length) % productImages.length;
            galleryImg.src = productImages[imgIndex];
        });

        document.querySelector('.next-btn').addEventListener('click', () => {
            if (productImages.length === 0) return;
            imgIndex = (imgIndex + 1) % productImages.length;
            galleryImg.src = productImages[imgIndex];
        });
    </script>
</body>
</html>
