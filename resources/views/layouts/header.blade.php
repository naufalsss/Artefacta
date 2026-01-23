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
            <li><a href="{{ route('home') }}#beranda">Beranda</a></li>
            <li><a href="{{ route('galleries.published') }}">Galeri</a></li>
            <li><a href="{{ route('home') }}#coffee">Coffee Shop</a></li>
            <li><a href="{{ route('home') }}#pemesanan">Pemesanan</a></li>
            <li><a href="{{ route('home') }}#tentang">Tentang</a></li>
        </ul>
    </nav>
</header>
