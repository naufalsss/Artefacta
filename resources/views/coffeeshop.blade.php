<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/coffeeshop.css') }}">
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




@include('layouts.footer')

<script src="{{ asset('js/coffeeshop.js') }}"></script>
</body>
</html>
