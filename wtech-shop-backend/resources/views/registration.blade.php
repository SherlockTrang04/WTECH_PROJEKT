<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Regitrácia</title>
</head>
<body>
    <div class="img-registration">
        <img src="{{ asset('assets/reg_img.jpg') }}" alt="registration image">
    </div>
    <div class="registration-container">
        <h1>Registrácia</h1>
        <form action="/registration" method="post">
             @csrf
            
            <label for="name">Meno a priezvisko:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="username">Používateľské meno:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Heslo (minimalne 8 znakov):</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="password">Heslo(Zadať ešte raz ):</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Registrovať sa</button>
            <a href="/login" class="back-link">Už máte účet? Prihláste sa</a>
            </a>
        </form>
    </div>
</body>
</html>