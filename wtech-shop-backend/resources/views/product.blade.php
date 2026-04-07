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
            <a class="navbar-brand p-0" href="index.html">
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
                        <a href="cart.html" class="nav-icon-btn" style="text-decoration:none;">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-icon-btn dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" style="background:transparent;border:none;">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="./login.html">Prihlásiť sa</a></li>
                            <li><a class="dropdown-item" href="/registration">Registrovať sa</a></li>
                        </ul>
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
                <button class="gallery-btn prev-btn">&#8249;</button>
                <img src="./assets/phones/honor.jpg" alt="product" class="gallery-img"/>
                <button class="gallery-btn next-btn">&#8250;</button>
            </div>

            <div class="product-info">
                <p class="product-info-label">HONOR SMARTPHONE</p>
                <p class="product-info-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                <p class="product-price">€199.99</p>

                    <div class="product-quantity">
                        <button class="qty-btn" onclick="changeQty(-1)">&#8722;</button>
                        <input
                                type="number"
                                id="qty"
                                value="1"
                                min="1"
                                max="99"
                                class="qty-input"
                                oninput="validateQty(this)"
                        />
                        <button class="qty-btn" onclick="changeQty(+1)">&#43;</button>
                        <span class="qty-err" id="qty-err"></span>
                    </div>

                <button class="add-to-cart-btn" onclick="location.href='./cart.html'">Do košíka</button>
                <!-- script na fungovanie tlacidiek + a - -->
                <script>
                    function changeQty(qty) {
                        const input = document.getElementById('qty');
                        let current = parseInt(input.value) || 1;
                        current += qty;
                        if (current < 1) current = 1;
                        if (current > 99) current = 99;
                        input.value = current;
                        document.getElementById("qty-err").textContent = '';
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
                            error.textContent = 'Množstvo nemôže byť viac ako 99'
                            input.value = 99;
                        } else if (!Number.isInteger(parseFloat(value))) {
                            error.textContent = 'Zadajte celé číslo';
                            input.value = Math.floor(value);
                        }
                        error.textContent = '';
                    }
                </script>
            </div>
        </div>
        <div class="product-params">
            <h2>Parametre:</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex
                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt
                mollit anim id est laborum</p>
        </div>

        <div class="similar-products">
            <h2>Podobné produkty:</h2>
            <div class="similar-row">
                <div class="product">
                    <img src="./assets/phones/phone-iphone.jpg" alt="produkt"/>
                    <p>Lorem ipsum dolor sit amet</p>
                    <span class="price">5€</span>
                </div>
                <div class="product">
                    <img src="./assets/phones/motorola.jpg" alt="produkt"/>
                    <p>Lorem ipsum dolor sit amet</p>
                    <span class="price">5€</span>
                </div>
                <div class="product">
                    <img src="./assets/phones/samsung.jpg" alt="produkt"/>
                    <p>Lorem ipsum dolor sit amet</p>
                    <span class="price">5€</span>
                </div>
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
</body>

</body>
</html>