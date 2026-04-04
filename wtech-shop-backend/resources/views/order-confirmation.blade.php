<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/order-confirmation.css') }}">
    <title>Elektroshop – Potvrdenie objednávky</title>
    
</head>
<body>

    <canvas id="confetti-canvas"></canvas>

    <nav class="navbar main-navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand p-0" href="index.html">
                <img src="./assets/logo.png" alt="logo" class="logo" />
            </a>
            <ul class="navbar-nav align-items-center gap-1 ms-auto">
                <li class="nav-item">
                    <a href="./cart.html" class="nav-icon-btn" style="text-decoration:none;">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="confirmation-page">

        <!-- Success icon -->
        <div class="success-circle">
            <i class="fa-solid fa-check"></i>
        </div>

        <!-- Heading -->
        <div class="confirm-heading">
            <h1>Objednávka prijatá!</h1>
            <p>Ďakujeme za váš nákup. Vaša objednávka bola úspešne spracovaná a čoskoro ju odošleme.</p>
            <span class="order-number-tag">Objednávka #EL-2025-004817</span>
        </div>

        <!-- Main grid -->
        <div class="confirm-grid">

            <!-- LEFT COLUMN -->
            <div style="display:flex;flex-direction:column;gap:20px;background-color:transparent;">

                <!-- Ordered items -->
                <div class="panel">
                    <p class="panel-title">Objednané produkty</p>
                    <div class="order-lines">

                        <div class="order-line">
                            <div class="order-line-img">
                                <i class="fa-solid fa-laptop"></i>
                            </div>
                            <div class="order-line-info">
                                <div class="order-line-name">MacBook Pro 14" M3 Pro</div>
                                <div class="order-line-meta">1× ks &nbsp;·&nbsp; Space Black</div>
                            </div>
                            <div class="order-line-price">€1 799.99</div>
                        </div>

                        <div class="order-line">
                            <div class="order-line-img">
                                <i class="fa-solid fa-headphones"></i>
                            </div>
                            <div class="order-line-info">
                                <div class="order-line-name">Sony WH-1000XM5</div>
                                <div class="order-line-meta">1× ks &nbsp;·&nbsp; Midnight Black</div>
                            </div>
                            <div class="order-line-price">€359.97</div>
                        </div>

                    </div>
                </div>

                <!-- Delivery info -->
                <div class="panel">
                    <p class="panel-title">Doručenie a platba</p>
                    <div class="info-grid">

                        <div class="info-block">
                            <div class="info-block-label">Doručiť na adresu</div>
                            <div class="info-block-value">
                                Ján Novák<br>
                                Obchodná 5<br>
                                811 06 Bratislava
                            </div>
                        </div>

                        <div class="info-block">
                            <div class="info-block-label">Kontakt</div>
                            <div class="info-block-value">
                                jan.novak@email.sk
                            </div>
                        </div>

                        <div class="info-block">
                            <div class="info-block-label">Spôsob dopravy</div>
                            <div class="info-block-value">
                                <span class="badge-ship">
                                    <i class="fa-solid fa-truck-fast"></i>
                                    Kuriér · €3.99
                                </span>
                            </div>
                        </div>

                        <div class="info-block">
                            <div class="info-block-label">Platba</div>
                            <div class="info-block-value">
                                <span class="badge-ship">
                                    <i class="fa-solid fa-credit-card"></i>
                                    Kartou online
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Order status tracker -->
                <div class="panel">
                    <p class="panel-title">Stav objednávky</p>
                    <div class="tracking-bar">

                        <div class="track-step">
                            <div class="track-dot done">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="track-label done-label">Prijatá</div>
                        </div>

                        <div class="track-step">
                            <div class="track-dot active">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            <div class="track-label active-label">Pripravuje sa</div>
                        </div>

                        <div class="track-step">
                            <div class="track-dot">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <div class="track-label">Na ceste</div>
                        </div>

                        <div class="track-step">
                            <div class="track-dot">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="track-label">Doručená</div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div>
                <div class="totals-panel">
                    <p class="panel-title">Cenové zhrnutie</p>

                    <div class="totals-row">
                        <span class="totals-label">Produkty</span>
                        <span class="totals-value">€2 159.96</span>
                    </div>
                    <div class="totals-row">
                        <span class="totals-label">Doprava</span>
                        <span class="totals-value">€3.99</span>
                    </div>

                    <hr class="totals-divider">

                    <div class="totals-final-row">
                        <span class="totals-final-label">Celkom</span>
                        <span class="totals-final-value">€2 163.95</span>
                    </div>

                    <div class="email-note">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Potvrdenie objednávky sme zaslali na <strong>jan.novak@email.sk</strong></span>
                    </div>

                    <a href="index.html" class="btn-continue">
                        Pokračovať v nákupe
                    </a>
                    <a href="order-status.html" class="btn-track">
                        <i class="fa-solid fa-magnifying-glass"></i> Sledovať objednávku
                    </a>
                </div>
            </div>

        </div>
    </div>

        

</body>
</html>