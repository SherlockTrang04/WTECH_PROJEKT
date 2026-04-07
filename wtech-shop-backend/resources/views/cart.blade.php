<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="bootstrap.min.css">  
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Košík</title>
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
        <aside class="desktop-sidebar sidebar d-none d-lg-block" style="width:200px; flex-shrink:0;">
            <ul class="categories">
                <li><a href="#"><i class="fa-solid fa-star"></i> Novinky</a></li>
                <li><a href="#"><i class="fa-solid fa-laptop"></i> Notebooky</a></li>
                <li><a href="#"><i class="fa-solid fa-desktop"></i> Počítače</a></li>
                <li><a href="#"><i class="fa-solid fa-mobile"></i> Smartfóny</a></li>
                <li><a href="#"><i class="fa-solid fa-computer-mouse"></i> Príslušenstvá</a></li>
                <li><a href="#"><i class="fa-solid fa-blender"></i> Spotrebiče</a></li>
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
        <h1 class="cart-title">Košík</h1>
        <div class="cart-items">
            <div class="cart-item">
                <img src="./assets/fridge.jpg" alt="produkt" class="cart-item-img" />
                <div class="cart-item-info">
                    <p class="cart-item-name">Lorem ipsum dolor.</p>
                    <p class="cart-item-price">51.59€</p>
                    <p class="cart-item-stock">Na sklade</p>
                    <div class="cart-item-quantity">
                        <button class="qty-btn">&#8722;</button>
                        <span class="qty-value">1</span>
                        <button class="qty-btn">&#43;</button>
                    </div>
                </div>
            </div>
            <div class="cart-item">
                <img src="./assets/iphone.jpg" alt="produkt" class="cart-item-img" />
                <div class="cart-item-info">
                    <p class="cart-item-name">ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
                    <p class="cart-item-price">10.49€</p>
                    <p class="cart-item-stock">Na sklade</p>
                    <div class="cart-item-quantity">
                        <button class="qty-btn">&#8722;</button>
                        <span class="qty-value">1</span>
                        <button class="qty-btn">&#43;</button>
                    </div>
                </div>
            </div>
            <div class="cart-item">
                <img src="./assets/cable.jpg" alt="produkt" class="cart-item-img" />
                <div class="cart-item-info">
                    <p class="cart-item-name">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                    <p class="cart-item-price">5€</p>
                    <p class="cart-item-stock">Na sklade</p>
                    <div class="cart-item-quantity">
                        <button class="qty-btn">&#8722;</button>
                        <span class="qty-value">1</span>
                        <button class="qty-btn">&#43;</button>
                    </div>
                </div>
            </div>
            <div class="cart-item">
                <img src="./assets/airpods.jpg" alt="produkt" class="cart-item-img" />
                <div class="cart-item-info">
                    <p class="cart-item-name">"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</p>
                    <p class="cart-item-price">50€</p>
                    <p class="cart-item-stock">Na sklade</p>
                    <div class="cart-item-quantity">
                        <button class="qty-btn">&#8722;</button>
                        <span class="qty-value">1</span>
                        <button class="qty-btn">&#43;</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-footer">
            <p class="cart-total">Total: 100€</p>
            <button class="checkout-btn" onclick="location.href='./shipping.html'">Prejsť na doručenie</button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>
