<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museum Barli</title>
    <link rel="stylesheet" href="{{ url('css/home.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<header>
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiBm_x73xYqoKu9munFuDX8kbES2Y7glRN7w&s" alt="Museum Barli Logo" class="logo-img">
            <div class="logo-text">
                <span class="logo-title">Museum Barli</span>
                <span class="logo-subtitle">Art & Heritage</span>
            </div>
        </div>
        <ul class="nav-menu">
            <li><a href="{{ route('login') }}">Akun</a></li>
            <li><a href="#beranda" class="active">Beranda</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="#coffee">Coffee Shop</a></li>
            <li><a href="#pemesanan">Pemesanan</a></li>
            <li><a href="#tentang">Tentang</a></li>
        </ul>
    </nav>
</header>


<!-- HERO HOME -->
<section class="museum-hero light-hero" id="beranda">
    <div class="light-hero-overlay"></div>

    <div class="museum-hero-content reveal">
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
        <div class="gallery-item item-wide">
            <img src="data:image/jpeg;base64,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" alt="Koleksi Museum">
        </div>
        <div class="gallery-item item-potrait">
            <img src="https://source.unsplash.com/500x600/?gallery,sculpture" alt="Koleksi Museum">
        </div>
        <div class="gallery-item item-medium-tall">
            <img src="https://source.unsplash.com/400x450/?artwork,classical" alt="Koleksi Museum">
        </div>
        <div class="gallery-item item-square">
            <img src="https://source.unsplash.com/450x700/?museum,heritage" alt="Koleksi Museum">
        </div>
        <div class="gallery-item item-landscape">
            <img src="https://source.unsplash.com/400x500/?art,renaissance" alt="Koleksi Museum">
        </div>
        <div class="gallery-item item-potrait">
            <img src="https://source.unsplash.com/700x500/?gallery,exhibition" alt="Koleksi Museum">
        </div>
        <div class="gallery-item item-medium-tall">
            <img src="https://source.unsplash.com/500x550/?museum,collection" alt="Koleksi Museum">
        </div>
        <div class="gallery-item item-square">
            <img src="https://source.unsplash.com/400x480/?art,portrait" alt="Koleksi Museum">
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
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.977235847561!2d107.57391421432019!3d-6.891035295018819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6b5e8b5e8b5%3A0x8b5e8b5e8b5e8b5!2sMuseum%20Barli!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>


<!-- FOOTER -->
<footer>
    <p>© 2026 Museum Barli. All Rights Reserved.</p>
</footer>

<script src="{{ url('js/home.js') }}"></script>
</body>
</html>
