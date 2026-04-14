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

    <title>Elektroshop – Produkty</title>

</head>
<body>

<!-- ── NAVBAR ───────────────────────────────────────── -->
<nav class="navbar main-navbar navbar-expand-lg">
    <div class="container-fluid">

        <a class="navbar-brand p-0" href="/">
            <img src="/assets/logo.png" alt="logo" class="logo"/>
        </a>

        <button class="navbar-toggler ms-auto me-2" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNavCollapse"
                aria-controls="mainNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavCollapse">
            <form method="GET" action="/product_list" class="mx-auto my-2 my-lg-0" style="width:100%;max-width:500px;">
                <input type="text" name="search" placeholder="Hľadať..." class="searchbar" value="{{ request('search') }}"/>
            </form>

            <ul class="navbar-nav align-items-center gap-1 ms-lg-3">
                <li class="nav-item">
                    <button class="nav-icon-btn" aria-label="Hľadať">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <a href="./cart" class="nav-icon-btn" style="text-decoration:none;">
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
    @php
        $categoryIcons = [
            'Smartfóny'      => 'fa-mobile',
            'Notebooky'      => 'fa-laptop',
            'Počítače'       => 'fa-desktop',
            'Príslušenstvo'  => 'fa-computer-mouse',
            'Spotrebiče'     => 'fa-blender',
        ];
    @endphp
    <aside class="sidebar d-none d-lg-block" style="width:200px; flex-shrink:0;">
        <ul class="categories">
            @foreach($categories as $cat)
                <li>
                    <a href="/product_list?category_id={{ $cat->id }}"
                       class="{{ request('category_id')==$cat->id ? 'active' : '' }}">
                        <i class="fa-solid {{ $categoryIcons[$cat->name] ?? 'fa-tag' }}"></i>
                        {{ $cat->name }}
                    </a>
                </li>
            @endforeach
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
                @foreach($categories as $cat)
                    <li>
                        <a href="/product_list?category_id={{ $cat->id }}"
                           class="{{ request('category_id')==$cat->id ? 'active' : '' }}">
                            <i class="fa-solid {{ $categoryIcons[$cat->name] ?? 'fa-tag' }}"></i>
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Content -->
    <main class="content-area flex-grow-1">

        <!-- Mobile: categories button -->
        <button class="sidebar-toggle-btn d-lg-none"
                data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <i class="fa-solid fa-bars"></i> Kategórie
        </button>

        <!-- Filter bar -->
        <form method="GET" action="/product_list" id="filterForm">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            @if(request('category_id'))
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            @endif
            <input type="hidden" name="price_min" id="hiddenMin" value="{{ request('price_min', 0) }}">
            <input type="hidden" name="price_max" id="hiddenMax" value="{{ request('price_max', 2000) }}">
            <input type="hidden" name="brand"     id="hiddenBrand" value="{{ request('brand') }}">
            <input type="hidden" name="stars"     id="hiddenStars" value="{{ request('stars', 0) }}">
            <div class="filter-bar">
                <p>Filter podľa:</p>
                <div style="position:relative;">
                    <button type="button" class="filter-btn" id="btnCeny">
                        Ceny <span id="activeBadge" class="active-badge" style="display:none"></span>
                    </button>

                    <div class="price-dropdown" id="priceDropdown">
                        <div class="price-display">
                            <span>Rozsah cien</span>
                            <strong id="displayRange">€0 – €2000</strong>
                        </div>

                        <div class="range-wrapper">
                            <div class="track-bg"></div>
                            <div class="track-fill" id="trackFill"></div>
                            <input type="range" id="rangeMin" min="0" max="2000" value="0" step="10">
                            <input type="range" id="rangeMax" min="0" max="2000" value="2000" step="10">
                        </div>

                        <div class="price-inputs">
                            <div class="price-input-group">
                                <label>Od (€)</label>
                                <input type="number" id="inputMin" min="0" max="2000" value="0">
                            </div>
                            <div class="price-input-group">
                                <label>Do (€)</label>
                                <input type="number" id="inputMax" min="0" max="2000" value="2000">
                            </div>
                        </div>

                        <div class="dropdown-actions">
                            <button type="button" class="btn-reset" id="btnReset">Resetovať</button>
                            <button type="button" class="btn-apply" id="btnApply">Použiť filter</button>
                        </div>
                    </div>
                </div>
                <div style="position:relative;">
                    <button type="button" class="filter-btn" id="btnZnacky">
                        Značky <span id="brandBadge" class="active-badge" style="display:none"></span>
                    </button>

                    <div class="brand-dropdown" id="brandDropdown">
                        <input class="brand-search" id="brandSearch" type="text" placeholder="Hľadať značku...">

                        <div class="select-all-row" id="selectAllRow">
                            <input type="checkbox" id="chkSelectAll">
                            <label for="chkSelectAll">Vybrať všetky</label>
                        </div>

                        <div class="brand-list" id="brandList"></div>

                        <hr class="dropdown-divider">
                        <div class="dropdown-actions">
                            <button type="button" class="btn-reset" id="btnBrandReset">Resetovať</button>
                            <button type="button" class="btn-apply" id="btnBrandApply">Použiť filter</button>
                        </div>
                    </div>
                </div>
                <div style="position:relative;">
                    <button type="button" class="filter-btn" id="btnHodnotenie">
                        Hodnotenie <span id="ratingBadge" class="active-badge" style="display:none"></span>
                    </button>

                    <div class="rating-dropdown" id="ratingDropdown">
                        <p class="rating-hint">Zobraziť produkty s hodnotením:</p>
                        <div class="rating-options" id="ratingOptions"></div>
                        <hr class="dropdown-divider">
                        <div class="dropdown-actions">
                            <button type="button" class="btn-reset" id="btnRatingReset">Resetovať</button>
                            <button type="button" class="btn-apply" id="btnRatingApply">Použiť filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Sort -->
        <div class="d-flex justify-content-end mb-3 mt-2">
            <select name="sort" form="filterForm" onchange="document.getElementById('filterForm').submit()"
                    class="form-select" style="width:auto;">
                <option value="newest"     {{ request('sort', 'newest') == 'newest'     ? 'selected' : '' }}>Najnovšie</option>
                <option value="price_asc"  {{ request('sort') == 'price_asc'            ? 'selected' : '' }}>Cena: od najnižšej</option>
                <option value="price_desc" {{ request('sort') == 'price_desc'           ? 'selected' : '' }}>Cena: od najvyššej</option>
{{--                <option value="stars_desc" {{ request('sort') == 'stars_desc'           ? 'selected' : '' }}>Hodnotenie</option>--}}
            </select>
        </div>

        <!-- Product grid -->
        <div class="row g-4 mb-4">
            @forelse($products as $product)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('product.show', $product) }}" style="text-decoration:none;">
                        <div class="product-card">
                            <img src="{{ $product->images->first()?->url ?? asset('assets/placeholder.jpg') }}"
                                 alt="{{ $product->name }}"/>
                            <div class="card-body">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->brand }}</p>
                                <span class="price">€{{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p>Žiadne produkty sa nenašli.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="paging">
            {{ $products->links() }}
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
    const MIN_GAP = 50, MAX_VAL = 2000;

    const btnCeny = document.getElementById('btnCeny');
    const dropdown = document.getElementById('priceDropdown');
    const rangeMin = document.getElementById('rangeMin');
    const rangeMax = document.getElementById('rangeMax');
    const inputMin = document.getElementById('inputMin');
    const inputMax = document.getElementById('inputMax');
    const trackFill = document.getElementById('trackFill');
    const badge = document.getElementById('activeBadge');

    function closeAllDropdowns() {
        dropdown.classList.remove('open');        btnCeny.classList.remove('active');
        brandDropdown.classList.remove('open');   btnZnacky.classList.remove('active');
        ratingDropdown.classList.remove('open');  btnHodnotenie.classList.remove('active');
    }

    btnCeny.addEventListener('click', e => {
        e.stopPropagation();
        const isOpen = dropdown.classList.contains('open');
        closeAllDropdowns();
        if (!isOpen) { dropdown.classList.add('open'); btnCeny.classList.add('active'); }
    });

    document.addEventListener('click', () => {
        dropdown.classList.remove('open');
        btnCeny.classList.remove('active');
    });
    dropdown.addEventListener('click', e => e.stopPropagation());

    function updateUI(min, max) {
        document.getElementById('displayRange').textContent = `€${min} – €${max}`;
        inputMin.value = min;
        inputMax.value = max;
        trackFill.style.left = (min / MAX_VAL * 100) + '%';
        trackFill.style.width = ((max - min) / MAX_VAL * 100) + '%';
    }

    function clampRanges() {
        let min = +rangeMin.value, max = +rangeMax.value;
        if (max - min < MIN_GAP) {
            if (event.target === rangeMin) rangeMin.value = min = max - MIN_GAP;
            else rangeMax.value = max = min + MIN_GAP;
        }
        updateUI(min, max);
    }

    rangeMin.addEventListener('input', clampRanges);
    rangeMax.addEventListener('input', clampRanges);

    inputMin.addEventListener('input', () => {
        let min = Math.max(0, Math.min(+inputMin.value || 0, MAX_VAL));
        let max = +rangeMax.value;
        if (min > max - MIN_GAP) min = max - MIN_GAP;
        rangeMin.value = min;
        updateUI(min, max);
    });
    inputMax.addEventListener('input', () => {
        let max = Math.max(0, Math.min(+inputMax.value || MAX_VAL, MAX_VAL));
        let min = +rangeMin.value;
        if (max < min + MIN_GAP) max = min + MIN_GAP;
        rangeMax.value = max;
        updateUI(min, max);
    });

    document.getElementById('btnApply').addEventListener('click', () => {
        const min = +rangeMin.value, max = +rangeMax.value;
        badge.style.display = (min === 0 && max === MAX_VAL) ? 'none' : 'inline-block';
        badge.textContent = `€${min}–€${max}`;
        dropdown.classList.remove('open');
        btnCeny.classList.remove('active');
        document.getElementById('hiddenMin').value = min;
        document.getElementById('hiddenMax').value = max;
        document.getElementById('filterForm').submit();
    });

    document.getElementById('btnReset').addEventListener('click', () => {
        rangeMin.value = 0;
        rangeMax.value = MAX_VAL;
        updateUI(0, MAX_VAL);
    });

    updateUI(0, MAX_VAL);

    const brands = [
        {name: "Apple", count: 12},
        {name: "Samsung", count: 18},
        {name: "Huawei", count: 9},
        {name: "Xiaomi", count: 14},
        {name: "Honor", count: 7},
        {name: "Sony", count: 5},
        {name: "Motorola", count: 8},
        {name: "OPPO", count: 6},
    ];

    let selectedBrands = new Set();
    let brandQuery = '';

    const btnZnacky = document.getElementById('btnZnacky');
    const brandDropdown = document.getElementById('brandDropdown');
    const brandList = document.getElementById('brandList');
    const brandSearch = document.getElementById('brandSearch');
    const brandBadge = document.getElementById('brandBadge');
    const chkAll = document.getElementById('chkSelectAll');

    function renderBrandList() {
        const q = brandQuery.toLowerCase();
        const filtered = brands.filter(b => b.name.toLowerCase().includes(q));
        brandList.innerHTML = '';
        if (!filtered.length) {
            brandList.innerHTML = '<div class="brand-no-results">Žiadne výsledky</div>';
            chkAll.checked = false;
            chkAll.indeterminate = false;
            return;
        }
        filtered.forEach(b => {
            const item = document.createElement('div');
            item.className = 'brand-item';
            const id = 'chk_' + b.name;
            item.innerHTML = `
            <input type="checkbox" id="${id}" ${selectedBrands.has(b.name) ? 'checked' : ''}>
            <label for="${id}">${b.name}</label>
            <span class="brand-count">${b.count}</span>
            `;
            item.querySelector('input').addEventListener('change', e => {
                e.target.checked ? selectedBrands.add(b.name) : selectedBrands.delete(b.name);
                updateSelectAll(filtered);
            });
            item.addEventListener('click', e => {
                if (e.target.tagName !== 'INPUT') item.querySelector('input').click();
            });
            brandList.appendChild(item);
        });
        updateSelectAll(filtered);
    }

    function updateSelectAll(filtered) {
        const n = filtered.filter(b => selectedBrands.has(b.name)).length;
        chkAll.checked = n === filtered.length && filtered.length > 0;
        chkAll.indeterminate = n > 0 && n < filtered.length;
    }

    chkAll.addEventListener('change', () => {
        const filtered = brands.filter(b => b.name.toLowerCase().includes(brandQuery));
        filtered.forEach(b => chkAll.checked ? selectedBrands.add(b.name) : selectedBrands.delete(b.name));
        renderBrandList();
    });

    brandSearch.addEventListener('input', () => {
        brandQuery = brandSearch.value;
        renderBrandList();
    });

    btnZnacky.addEventListener('click', e => {
        e.stopPropagation();
        const isOpen = brandDropdown.classList.contains('open');
        closeAllDropdowns();
        if (!isOpen) {
            brandDropdown.classList.add('open');
            btnZnacky.classList.add('active');
            brandSearch.value = '';
            brandQuery = '';
            renderBrandList();
            brandSearch.focus();
        }
    });

    document.addEventListener('click', () => {
        brandDropdown.classList.remove('open');
        btnZnacky.classList.remove('active');
    });
    brandDropdown.addEventListener('click', e => e.stopPropagation());

    document.getElementById('btnBrandApply').addEventListener('click', () => {
        if (selectedBrands.size === 0) {
            brandBadge.style.display = 'none';
        } else if (selectedBrands.size <= 2) {
            brandBadge.textContent = [...selectedBrands].join(', ');
            brandBadge.style.display = 'inline-block';
        } else {
            brandBadge.textContent = `${selectedBrands.size} značky`;
            brandBadge.style.display = 'inline-block';
        }
        brandDropdown.classList.remove('open');
        btnZnacky.classList.remove('active');
        document.getElementById('hiddenBrand').value = [...selectedBrands].join(',');
        document.getElementById('filterForm').submit();
    });

    document.getElementById('btnBrandReset').addEventListener('click', () => {
        selectedBrands.clear();
        renderBrandList();
    });

    renderBrandList();
    const ratingOptions = [
        {value: 4.5, label: "a viac"},
        {value: 4, label: "a viac"},
        {value: 3, label: "a viac"},
        {value: 2, label: "a viac"},
        {value: 0, label: ""},
    ];

    let selectedRating = 0;

    const btnHodnotenie = document.getElementById('btnHodnotenie');
    const ratingDropdown = document.getElementById('ratingDropdown');
    const ratingBadge = document.getElementById('ratingBadge');
    const ratingContainer = document.getElementById('ratingOptions');

    function renderStars(value) {
        let html = '<div class="stars">';
        for (let i = 1; i <= 5; i++) {
            html += `<span class="star ${value >= i ? 'filled' : 'empty'}">★</span>`;
        }
        return html + '</div>';
    }

    function renderRatingList() {
        ratingContainer.innerHTML = '';
        ratingOptions.forEach(opt => {
            const row = document.createElement('label');
            row.className = 'rating-option';
            row.innerHTML = `
            <input type="radio" name="rating" value="${opt.value}" ${selectedRating === opt.value ? 'checked' : ''}>
            ${opt.value > 0
                ? renderStars(opt.value) + `<span class="rating-option-label">${opt.value}+ ${opt.label}</span>`
                : '<span style="color:rgba(242,241,241,0.6);font-size:0.88rem;">Bez filtra</span>'
            }
            `;
            row.querySelector('input').addEventListener('change', () => {
                selectedRating = opt.value;
            });
            ratingContainer.appendChild(row);
        });
    }

    btnHodnotenie.addEventListener('click', e => {
        e.stopPropagation();
        const isOpen = ratingDropdown.classList.contains('open');
        closeAllDropdowns();
        if (!isOpen) {
            ratingDropdown.classList.add('open');
            btnHodnotenie.classList.add('active');
            renderRatingList();
        }
    });

    document.addEventListener('click', () => {
        ratingDropdown.classList.remove('open');
        btnHodnotenie.classList.remove('active');
    });
    ratingDropdown.addEventListener('click', e => e.stopPropagation());

    document.getElementById('btnRatingApply').addEventListener('click', () => {
        ratingBadge.style.display = selectedRating === 0 ? 'none' : 'inline-block';
        ratingBadge.textContent = selectedRating + '★+';
        ratingDropdown.classList.remove('open');
        btnHodnotenie.classList.remove('active');
        document.getElementById('hiddenStars').value = selectedRating;
        document.getElementById('filterForm').submit();
    });

    document.getElementById('btnRatingReset').addEventListener('click', () => {
        selectedRating = 0;
        renderRatingList();
    });

    renderRatingList();
</script>
</body>
</html>
