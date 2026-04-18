<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user_info.css') }}">
    <title>Moje údaje</title>
</head>
<body>

    <!-- ── NAVBAR ── -->
    <nav class="navbar main-navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand p-0" href="/">
                <img src="./assets/logo.png" alt="logo" class="logo" />
            </a>
            <button class="navbar-toggler ms-auto me-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNavCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavCollapse">
                <div class="mx-auto my-2 my-lg-0" style="width:100%;max-width:500px;">
                    <input type="text" placeholder="Hľadať..." class="searchbar" />
                </div>
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
                        <button class="nav-icon-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background:transparent;border:none;">
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

    @php
        $user      = auth()->user();
        $nameParts = explode(' ', $user->name);
        $initials  = collect($nameParts)->map(fn($w) => strtoupper(substr($w, 0, 1)))->implode('');
    @endphp

    <div class="page-body">

        <!-- ── PROFILE SIDEBAR ── -->
        <aside class="profile-sidebar">
            <div class="sidebar-avatar">
                <div class="avatar-circle">{{ $initials }}</div>
                <div>
                    <div class="avatar-name">{{ $user->name }}</div>
                    <div class="avatar-email">{{ $user->email }}</div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <button class="sidebar-nav-item active" data-section="profile" onclick="switchSection('profile', this)">
                    <i class="fa-solid fa-user"></i>
                    Moje údaje
                </button>
                <button class="sidebar-nav-item" data-section="orders" onclick="switchSection('orders', this)">
                    <i class="fa-solid fa-box"></i>
                    Moje objednávky
                </button>

                <div class="sidebar-divider"></div>

                <button class="sidebar-nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Odhlásiť sa
                </button>
            </nav>
        </aside>

        <!-- ── MAIN CONTENT ── -->
        <main class="profile-content">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- SECTION: Profile / Moje údaje -->
            <div id="section-profile" class="profile-section active">
                <div class="section-header">
                    <h1>Moje údaje</h1>
                    <p>Spravujte svoje osobné a doručovacie informácie</p>
                </div>

                <!-- View mode -->
                <div id="view-mode">
                    <div class="info-card">
                        <div class="info-card-title">Osobné údaje</div>
                        <div class="info-row">
                            <span class="info-label">Meno a priezvisko</span>
                            <span class="info-value">{{ $user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Používateľské meno</span>
                            <span class="info-value">{{ $user->username }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Telefón</span>
                            <span class="info-value">{{ $user->phone ?? '—' }}</span>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-title">Doručovacia adresa</div>
                        <div class="info-row">
                            <span class="info-label">Ulica a číslo</span>
                            <span class="info-value">
                                {{ trim(($user->address_street ?? '') . ' ' . ($user->address_house_number ?? '')) ?: '—' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">PSČ</span>
                            <span class="info-value">{{ $user->address_zip ?? '—' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Mesto</span>
                            <span class="info-value">{{ $user->address_city ?? '—' }}</span>
                        </div>
                    </div>

                    <button class="btn-save" onclick="toggleEdit()">
                        <i class="fa-solid fa-pen-to-square" style="background:transparent; margin-right:6px;"></i>
                        Upraviť údaje
                    </button>
                </div>

                <!-- Edit mode -->
                <div id="edit-mode" style="display:none;">
                    <form action="{{ route('user.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="info-card">
                            <div class="info-card-title">Osobné údaje</div>
                            <div class="form-grid" style="margin-top:4px;">
                                <div class="form-group full">
                                    <label>MENO A PRIEZVISKO</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" />
                                </div>
                                <div class="form-group full">
                                    <label>POUŽÍVATEĽSKÉ MENO</label>
                                    <input type="text" name="username" value="{{ old('username', $user->username) }}" />
                                </div>
                                <div class="form-group full">
                                    <label>EMAIL</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" />
                                </div>
                                <div class="form-group full">
                                    <label>TELEFÓN</label>
                                    <input type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-card-title">Doručovacia adresa</div>
                            <div class="form-grid" style="margin-top:4px;">
                                <div class="form-group">
                                    <label>ULICA</label>
                                    <input type="text" name="address_street" value="{{ old('address_street', $user->address_street ?? '') }}" />
                                </div>
                                <div class="form-group">
                                    <label>ČÍSLO</label>
                                    <input type="text" name="address_house_number" value="{{ old('address_house_number', $user->address_house_number ?? '') }}" />
                                </div>
                                <div class="form-group">
                                    <label>PSČ</label>
                                    <input type="text" name="address_zip" value="{{ old('address_zip', $user->address_zip ?? '') }}" />
                                </div>
                                <div class="form-group">
                                    <label>MESTO</label>
                                    <input type="text" name="address_city" value="{{ old('address_city', $user->address_city ?? '') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">Uložiť zmeny</button>
                            <button type="button" class="btn-cancel" onclick="toggleEdit()">Zrušiť</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SECTION: Orders / Moje objednávky -->
            <div id="section-orders" class="profile-section">
                <div class="section-header">
                    <h1>Moje objednávky</h1>
                    <p>História vašich nákupov a stav doručenia</p>
                </div>

                <!-- Order 1 -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">#ORD-2024-00841</div>
                            <div class="order-date">12. marca 2025</div>
                        </div>
                        <span class="order-status-badge badge-delivered">
                            <i class="fa-solid fa-circle-check" style="background:transparent;font-size:0.7rem;"></i>
                            Doručené
                        </span>
                    </div>
                    <div class="order-items-row">
                        <div class="order-thumb">
                            <i class="fa-solid fa-laptop"></i>
                        </div>
                        <div>
                            <div class="order-item-name">MacBook Pro 14" M3</div>
                            <div class="order-item-meta">1 ks · Strieborná</div>
                        </div>
                    </div>
                    <div class="order-footer">
                        <div>
                            <div class="order-total-label">Celková suma</div>
                            <div class="order-total-value">2 199,00 €</div>
                        </div>
                        <a href="#" class="order-detail-link">
                            Detail objednávky <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Order 2 -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">#ORD-2025-00102</div>
                            <div class="order-date">18. januára 2025</div>
                        </div>
                        <span class="order-status-badge badge-shipped">
                            <i class="fa-solid fa-truck" style="background:transparent;font-size:0.7rem;"></i>
                            V preprave
                        </span>
                    </div>
                    <div class="order-items-row">
                        <div class="order-thumb">
                            <i class="fa-solid fa-mobile"></i>
                        </div>
                        <div>
                            <div class="order-item-name">iPhone 16 Pro 256 GB</div>
                            <div class="order-item-meta">1 ks · Natural Titanium</div>
                        </div>
                    </div>
                    <div class="order-footer">
                        <div>
                            <div class="order-total-label">Celková suma</div>
                            <div class="order-total-value">1 249,00 €</div>
                        </div>
                        <a href="#" class="order-detail-link">
                            Detail objednávky <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Order 3 -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">#ORD-2025-00215</div>
                            <div class="order-date">3. februára 2025</div>
                        </div>
                        <span class="order-status-badge badge-processing">
                            <i class="fa-solid fa-hourglass-half" style="background:transparent;font-size:0.7rem;"></i>
                            Spracováva sa
                        </span>
                    </div>
                    <div class="order-items-row">
                        <div class="order-thumb">
                            <i class="fa-solid fa-computer-mouse"></i>
                        </div>
                        <div>
                            <div class="order-item-name">Logitech MX Master 3S</div>
                            <div class="order-item-meta">2 ks · Čierna</div>
                        </div>
                    </div>
                    <div class="order-footer">
                        <div>
                            <div class="order-total-label">Celková suma</div>
                            <div class="order-total-value">199,00 €</div>
                        </div>
                        <a href="#" class="order-detail-link">
                            Detail objednávky <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- ── FOOTER ── -->
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
        function switchSection(sectionId, btn) {
            document.querySelectorAll('.profile-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.sidebar-nav-item').forEach(b => b.classList.remove('active'));
            document.getElementById('section-' + sectionId).classList.add('active');
            btn.classList.add('active');
        }

        function toggleEdit() {
            const viewMode = document.getElementById('view-mode');
            const editMode = document.getElementById('edit-mode');
            const isEditing = editMode.style.display !== 'none';

            if (isEditing) {
                viewMode.style.display = 'block';
                editMode.style.display = 'none';
            } else {
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
            }
        }

        // Re-open edit mode if there were validation errors
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => toggleEdit());
        @endif
    </script>
</body>
</html>