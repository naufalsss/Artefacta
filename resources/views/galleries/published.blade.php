<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Museum Barli</title>
    <link rel="stylesheet" href="{{ url('css/home.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <style>
        .gallery-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .gallery-section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .gallery-section-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .gallery-section-header p {
            font-size: 1.1rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .gallery-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery-card-image {
            width: 100%;
            height: 240px;
            overflow: hidden;
            background: #f0f0f0;
            position: relative;
        }

        .gallery-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-card:hover .gallery-card-image img {
            transform: scale(1.05);
        }

        .gallery-card-content {
            padding: 20px;
        }

        .gallery-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .gallery-card-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .gallery-card-artifact {
            font-size: 0.85rem;
            color: #888;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .gallery-empty {
            text-align: center;
            padding: 60px 20px;
        }

        .gallery-empty-icon {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        .gallery-empty h2 {
            color: #999;
            margin-bottom: 10px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #2c3e50;
            color: white;
            border-color: #2c3e50;
        }

        .pagination .active {
            background: #2c3e50;
            color: white;
            border-color: #2c3e50;
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

@include('layouts.header')

<!-- HERO GALLERY -->
<section class="museum-hero light-hero">
    <div class="light-hero-overlay"></div>
    <div class="museum-hero-content reveal">
        <span class="hero-label">Jelajahi Karya</span>
        <h1>Galeri Museum</h1>
        <p>Koleksi seni dan artefak yang telah dikurasi dengan teliti untuk Anda nikmati.</p>
    </div>
</section>

<!-- GALLERY CONTENT -->
<section>
    <div class="gallery-container">
        <div class="gallery-section-header reveal">
            <h1>Galeri Kami</h1>
            <p>Temukan berbagai koleksi seni dan artefak berharga yang telah melalui seleksi ketat dari tim kurator kami.</p>
        </div>

        @if($galleries->count() > 0)
            <div class="gallery-grid reveal">
                @foreach($galleries as $gallery)
                <a href="{{ asset('storage/'.$gallery->image_path) }}" class="gallery-card glightbox" data-gallery="gallery">
                    <div class="gallery-card-image">
                        @if($gallery->image_path)
                            @if($gallery->crop_width && $gallery->crop_height)
                                <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->title }}" style="position: absolute; left: -{{ $gallery->crop_x ?? 0 }}px; top: -{{ $gallery->crop_y ?? 0 }}px; width: auto; height: auto; min-width: calc(100% + {{ $gallery->crop_x ?? 0 }}px); min-height: calc(100% + {{ $gallery->crop_y ?? 0 }}px);">
                            @else
                                <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->title }}">
                            @endif
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                                <span style="color: #ccc; font-size: 3rem;">📷</span>
                            </div>
                        @endif
                    </div>
                    <div class="gallery-card-content">
                        <div class="gallery-card-title">{{ $gallery->title }}</div>
                        <div class="gallery-card-description">
                            {{ $gallery->description }}
                        </div>
                        @if($gallery->artifact)
                        <div class="gallery-card-artifact">
                            <strong>Artefak:</strong> {{ $gallery->artifact->name }}
                        </div>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            @if($galleries->hasPages())
            <div class="pagination reveal">
                {{-- Previous Page Link --}}
                @if ($galleries->onFirstPage())
                    <span class="disabled">&laquo; Sebelumnya</span>
                @else
                    <a href="{{ $galleries->previousPageUrl() }}">&laquo; Sebelumnya</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($galleries->getUrlRange(1, $galleries->lastPage()) as $page => $url)
                    @if ($page == $galleries->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($galleries->hasMorePages())
                    <a href="{{ $galleries->nextPageUrl() }}">Selanjutnya &raquo;</a>
                @else
                    <span class="disabled">Selanjutnya &raquo;</span>
                @endif
            </div>
            @endif

        @else
            <div class="gallery-empty reveal">
                <div class="gallery-empty-icon">📭</div>
                <h2>Galeri Kosong</h2>
                <p>Belum ada koleksi yang tersedia saat ini. Silakan kunjungi kembali nanti!</p>
            </div>
        @endif
    </div>
</section>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script src="{{ url('js/home.js') }}"></script>
<script>
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: true
    });
</script>
</body>
</html>
