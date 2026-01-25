<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museum Barli</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

@include('layouts.header')

<!-- HERO HOME -->
<section class="museum-hero"
    style="background-image: url('{{ asset('foto/barli.png') }}');">
    <div class="hero-bg"></div>

    <div class="museum-hero-content">
        <span class="hero-label">Museum Seni & Budaya</span>
        <h1>Museum Barli</h1>
        <p>
            Ruang hening untuk menikmati seni, sejarah,
            dan warisan budaya dalam kurasi modern.
        </p>

        <a href="#galeri" class="hero-btn light-btn">Jelajahi Koleksi</a>
    </div>
</section>

<!-- GALERI -->
<section class="museum-gallery reveal" id="galeri">
    <div class="gallery-header">
        <h2>Galeri Koleksi</h2>
        <p class="gallery-desc">
            Koleksi seni yang menginspirasi dan membawa Anda menjelajahi perjalanan sejarah budaya.
        </p>
    </div>

    <div class="gallery-grid">
        <div class="gallery-item portrait">
            <img src="{{ asset('foto/potrait.png') }}" alt="">
            <div class="gallery-info">
        <h4>Madonna with Saints</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>

        <div class="gallery-item tall">
            <img src="{{ asset('foto/tall.png') }}" alt="">
            <div class="gallery-info">
        <h4>Pallas and the Centaur</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>

        <div class="gallery-item square">
            <img src="{{ asset('foto/square.png') }}" alt="">
            <div class="gallery-info">
        <h4>Alessandro di Mariano</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>

        <div class="gallery-item tall">
            <img src="{{ asset('foto/tall2.png') }}" alt="">
           <div class="gallery-info">
        <h4>The Adoration of the Magi</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>

        <div class="gallery-item portrait">
            <img src="{{ asset('foto/potrait2.png') }}" alt="">
            <div class="gallery-info">
        <h4>Calumny of Apelles</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>

        <div class="gallery-item square">
            <img src="{{ asset('foto/square2.png') }}" alt="">
            <div class="gallery-info">
        <h4>Annunciation</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>

        <div class="gallery-item portrait">
            <img src="{{ asset('foto/potrait3.png') }}" alt="">
            <div class="gallery-info">
        <h4>Madonna with Saints</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>

        <div class="gallery-item square">
            <img src="{{ asset('foto/square3.png') }}" alt="">
            <div class="gallery-info">
        <h4>Alessandro di Mariano</h4>
        <p>Lukisan religius era Renaissance dengan detail simbolik.</p>
        </div>
    </div>
</section>

<!-- LOKASI -->
<section class="home-location reveal" id="lokasi">
    <div class="location-wrapper">
        <div class="location-content">
            <h2>Lokasi Museum</h2>
            <div class="location-address">
                <p>
                    <strong>Alamat:</strong><br>
                    Jl. Prof. Dr. Sutami No.91, Sukarasa,<br>
                    Kec. Sukasari, Kota Bandung,<br>
                    Jawa Barat 40152
                </p>
                <p class="location-contact">
                    <strong>Kontak:</strong><br>
                    Telp: (022) 2011889<br>
                    Email: info@museum-barli.com
                </p>
            </div>
        </div>

        <div class="location-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.101833557978!2d107.58497797317823!3d-6.878401967299722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e68fe62d7cbb%3A0x4d93f4df24206370!2sMuseum%20Barli!5e0!3m2!1sid!2sid!4v1769264389936!5m2!1sid!2sid"
                width="600"
                height="450"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

@include('layouts.footer')

<script src="{{ url('js/home.js') }}"></script>
</body>
</html>
