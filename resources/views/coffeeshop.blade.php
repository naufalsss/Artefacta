<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/coffeeshop.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Coffee Shop</title>
</head>
<body>

@include('layouts.header')

<section class="hero">
    <div class="hero-slider">
        <img src="{{ asset('foto/cafebarli.png') }}" class="slide active">
        <img src="{{ asset('foto/cafebarli2.png') }}" class="slide">
        <img src="{{ asset('foto/cafebarli3.png') }}" class="slide">
    </div>

    <div class="hero-overlay"></div>
    <div class="hero-art"></div>


    <div class="hero-content glass">
        <h1 class="hero-title reveal">ARTEFACT COFFEE</h1>
        <p class="hero-tagline reveal delay">
            Where Coffee Becomes a Timeless Experience
        </p>

        <div class="hero-buttons reveal delay-2">
            <a href="#menu" class="btn-outline">Lihat Menu</a>
            <a href="#order" class="btn-primary">Pesan Sekarang</a>
        </div>
    </div>

    <div class="grain"></div>
</section>

<!-- KONSEP -->
<section class="section concept" id="concept">

    <div class="hero-artifact">
        <img src="{{ asset('foto/cangkirkopi.png') }}"
             alt="Cangkir Kopi Nusantara">
        <div class="artifact-label">
            Artefak 01 — Cangkir Kopi Tanah Liat, Jawa
        </div>
    </div>

    <div class="concept-text">
        <div class="label">Exhibition Introduction</div>
        <h2>Konsep Coffee Shop</h2>

        <p>
            Coffee & Memory lahir sebagai ruang hening di antara aroma kopi dan ingatan.
            Terinspirasi dari museum, tempat ini memperlakukan kopi Nusantara
            sebagai artefak hidup—diseduh perlahan, dirasakan, dan dikenang.
        </p>

        <blockquote>
            “Kopi Nusantara bukan sekadar rasa,
            ia adalah jejak waktu yang diwariskan.”
        </blockquote>
    </div>
</section>

<!-- HUBUNGAN KOPI & MUSEUM -->
<section class="section connection" id="connection">
    <div class="connection-wrapper">
        <div class="connection-header">
            <div class="label">Coffee as Living Artifact</div>
        </div>

        <div class="connection-layout">
            <div class="connection-text">
                <div class="connection-header">
                    <h2 class="split-title"> Hubungan Kopi &<br>Museum.</h2>
                </div>
                <p>Museum menjaga benda agar tetap diam.</p>
                <p>Kopi melakukan hal sebaliknya—ia hidup, berubah, dan habis.</p>
                <p>Namun keduanya bertemu pada satu hal: menjaga ingatan.</p>
            </div>

            <div class="artifact">
                <small>Instalasi Kopi Nusantara</small>
                <img src="{{ asset('foto/suasana.png') }}" alt="Suasana Kopi Nusantara">
                <div class="caption">
                    Gayo, Toraja, Kintamani — arsip rasa Nusantara
                </div>
            </div>
        </div>
    </div>
</section>

<div class="menu-exhibition">
  <div class="exhibition-container-full">

    {{-- ===== MENU CONTENT ===== --}}
    <div class="exhibition-gallery-full">

      {{-- ALL MENU --}}
      <div class="gallery-header-inline">
        <h3 class="gallery-title-inline">Our Menu</h3>
      </div>
      <div class="artifacts-grid-all">
        @php $index = 0; @endphp
        @foreach($allMenus->chunk(2) as $menuPair)
          @foreach($menuPair as $menu)
            <div class="artifact-card-all menu-card" data-menu-id="{{ $menu->id }}" data-index="{{ $index }}">
              <div class="artifact-image-left">
                @if($menu->image && file_exists(storage_path('app/public/'.$menu->image)))
                  <img class="artifact-image" src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                @else
                  <div class="artifact-image-placeholder"></div>
                @endif
                @if($menu->is_signature)
                  <div class="signature-badge-main">Signature</div>
                @endif
              </div>
              <div class="artifact-info-right">
                <h4 class="artifact-name">{{ $menu->name }}</h4>
                <p class="artifact-description">{{ Str::limit($menu->description, 80) }}</p>
                <div class="artifact-price">Rp {{ number_format($menu->price,0,',','.') }}</div>
              </div>
            </div>
            @php $index++; @endphp
          @endforeach
        @endforeach
      </div>

      <!-- MODAL DETAIL MENU -->
      <div id="menuModal" class="menu-modal">
        <div class="menu-modal-overlay" onclick="closeMenuModal()"></div>
        <div class="menu-modal-content">
          <button class="menu-modal-close" onclick="closeMenuModal()">&times;</button>
          <div class="menu-modal-body">
            <div class="menu-modal-image">
              <img id="modalMenuImage" src="" alt="" class="modal-image">
            </div>
            <div class="menu-modal-info">
              <h2 id="modalMenuName" class="modal-menu-name"></h2>
              <p id="modalMenuDescription" class="modal-menu-description"></p>
              <div class="modal-menu-price">Rp <span id="modalMenuPrice"></span></div>
              <div class="modal-menu-actions">
                <button class="btn-order-kasir">
                  <i class="fas fa-cash-register"></i> Pesan ke Kasir
                </button>
                <button class="btn-add-cart">
                  <i class="fas fa-shopping-cart"></i> Masukkan ke Keranjang
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
@include('layouts.footer')


<script src="{{asset('js/coffeeshop.js')}}"></script>
</body>
</html>
