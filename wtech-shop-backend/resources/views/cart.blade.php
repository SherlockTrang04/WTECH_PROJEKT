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
                            <li><a class="dropdown-item" href="/login">Prihlásiť sa</a></li>
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
                <li><a href="/product_list"><i class="fa-solid fa-laptop"></i> Notebooky</a></li>
                <li><a href="/product_list"><i class="fa-solid fa-mobile"></i> Smartfóny</a></li>
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
                    <li><a href="/product_list"><i class="fa-solid fa-laptop"></i> Notebooky</a></li>
                    <li><a href="/product_list"><i class="fa-solid fa-mobile"></i> Smartfóny</a></li>
                </ul>
            </div>
        </div>

        <div class="content-area flex-grow-1">
            <h1 class="cart-title">Košík</h1>

            @if($items->isEmpty())
                <p class="mt-4">Váš košík je prázdny.</p>
            @else
                <div class="cart-items">
                    @foreach($items as $item)
                        <div class="cart-item" data-price="{{ $item->product->price }}">
                            <img src="{{ $item->product->images->first()?->url ?? asset('assets/placeholder.jpg') }}"
                                 alt="{{ $item->product->name }}" class="cart-item-img" />
                            <div class="cart-item-info">
                                <p class="cart-item-name">{{ $item->product->name }}</p>
                                <p class="cart-item-price">€{{ number_format($item->product->price, 2) }}</p>
                                <p class="cart-item-stock">{{ $item->product->stock > 0 ? 'Na sklade' : 'Nedostupné' }}</p>

                                {{-- Zmena množstva --}}
                                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="cart-item-quantity">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="qty-btn" onclick="changeItemQty(this, -1)">&#8722;</button>
                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                           min="1" class="qty-value" oninput="updateTotal()" />
                                    <button type="button" class="qty-btn" onclick="changeItemQty(this, 1)">&#43;</button>
                                    <button type="submit" class="add-to-cart-btn" style="font-size:0.85rem;padding:6px 14px;">Uložiť</button>
                                </form>

                                {{-- Vymazať položku --}}
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="qty-btn" style="margin-top:8px;">&#10005;</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="cart-footer">
                    <p class="cart-total">Celkom: <span id="cartTotal">€{{ number_format($total, 2) }}</span></p>
                    <a href="/shipping" class="checkout-btn">Prejsť na doručenie</a>
                </div>
            @endif
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
<script>
    function changeItemQty(btn, delta) {
        const input = btn.closest('form').querySelector('input[name="quantity"]');
        let val = parseInt(input.value) || 1;
        val += delta;
        if (val < 1) val = 1;
        input.value = val;
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.dataset.price) || 0;
            const qty = parseInt(item.querySelector('input[name="quantity"]').value) || 1;
            total += price * qty;
        });
        document.getElementById('cartTotal').textContent = '€' + total.toFixed(2);
    }
</script>
</body>
</html>
