<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Museum Barli</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .about-hero {
            background-image: url('{{ asset('foto/barli.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Subtle parallax effect */
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: white;
            overflow: hidden;
        }
        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(196, 154, 108, 0.4) 50%, rgba(166, 124, 82, 0.4) 100%);
            animation: overlayFadeIn 2s ease-out;
        }
        .about-hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="texture" patternUnits="userSpaceOnUse" width="20" height="20"><rect width="20" height="20" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="10" r="1" fill="rgba(255,215,0,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23texture)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }
        @keyframes overlayFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .about-hero-content {
            position: relative;
            text-align: center;
            z-index: 1;
            animation: contentSlideUp 1.5s ease-out 0.5s both;
        }
        @keyframes contentSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Particle Effects */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particleFloat 8s linear infinite;
        }
        .particle:nth-child(1) { width: 4px; height: 4px; top: 10%; left: 20%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 6px; height: 6px; top: 20%; left: 80%; animation-delay: 1s; }
        .particle:nth-child(3) { width: 3px; height: 3px; top: 50%; left: 10%; animation-delay: 2s; }
        .particle:nth-child(4) { width: 5px; height: 5px; top: 70%; left: 90%; animation-delay: 3s; }
        .particle:nth-child(5) { width: 4px; height: 4px; top: 30%; left: 50%; animation-delay: 4s; }
        .particle:nth-child(6) { width: 7px; height: 7px; top: 80%; left: 30%; animation-delay: 5s; }
        .particle:nth-child(7) { width: 3px; height: 3px; top: 60%; left: 70%; animation-delay: 6s; }
        .particle:nth-child(8) { width: 5px; height: 5px; top: 40%; left: 15%; animation-delay: 7s; }
        @keyframes particleFloat {
            0% { transform: translateY(0) rotate(0deg); opacity: 0.6; }
            50% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
        .about-hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .about-hero-content p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        .about-section {
            padding: 80px 0;
            max-width: 1200px;
            margin: 0 auto;
        }
        .about-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }
        .story-section {
            background: #FAF4EF;
            padding: 60px 0;
        }
        .story-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .value-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .value-card:hover {
            transform: translateY(-5px);
        }
        .value-card h3 {
            font-family: 'Playfair Display', serif;
            color: #C49A6C;
            margin-bottom: 1rem;
        }
        .experience-list {
            list-style: none;
            padding: 0;
            max-width: 800px;
            margin: 0 auto;
        }
        .experience-list li {
            background: white;
            margin: 1rem 0;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }
        .experience-list li::before {
            content: '☕';
            font-size: 1.5rem;
            margin-right: 1rem;
            color: #C49A6C;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .info-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1), inset 0 1px 0 rgba(255,255,255,0.8);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }
        .info-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(196, 154, 108, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s;
            pointer-events: none;
        }
        .info-card:hover::before {
            opacity: 1;
        }
        .info-card:hover {
            transform: translateY(-10px) rotate(1deg);
            box-shadow: 0 20px 60px rgba(232, 93, 4, 0.2), inset 0 1px 0 rgba(255,255,255,0.9);
        }
        .info-card h3 {
            font-family: 'Playfair Display', serif;
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            font-size: 1.3rem;
        }
        .info-card .card-icon {
            font-size: 1.8rem;
            margin-right: 0.5rem;
            transition: all 0.3s;
        }
        .info-card:hover .card-icon {
            animation: iconBounce 0.6s ease-in-out;
            filter: drop-shadow(0 4px 8px rgba(196, 154, 108, 0.4));
        }
        @keyframes iconBounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0) scale(1); }
            40% { transform: translateY(-8px) scale(1.1); }
            60% { transform: translateY(-4px) scale(1.05); }
        }
        .info-card p {
            line-height: 1.6;
            color: #555;
        }
        .info-card a {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s;
        }
        .info-card a:hover {
            color: #A67C52;
            text-decoration: underline;
        }
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #C49A6C 0%, #A67C52 100%);
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(196, 154, 108, 0.3);
        }
        .social-link:hover {
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 8px 16px rgba(218, 165, 32, 0.4);
        }
        .social-link svg {
            width: 20px;
            height: 20px;
        }
        .history-section {
            background: linear-gradient(135deg, #FAF4EF 0%, #FAF4EF 50%, #FAF4EF 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        .history-section::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(232, 93, 4, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(50px);
            z-index: 0;
        }
        .history-section .container {
            position: relative;
            z-index: 1;
        }
        .history-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: justify;
            line-height: 1.6;
        }
        /* Scroll Reveal Animations */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s ease;
        }
        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s ease;
        }
        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }
        /* Enhanced Story Section */
        .story-content {
            position: relative;
        }
        .story-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(232, 93, 4, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(196, 30, 58, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }
        .story-highlight {
            background: linear-gradient(135deg, #C49A6C 0%, #A67C52 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin: 2rem 0;
            text-align: center;
            font-style: italic;
            font-size: 1.2rem;
            box-shadow: 0 8px 32px rgba(196, 154, 108, 0.3);
            animation: highlightPulse 3s ease-in-out infinite;
        }
        @keyframes highlightPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        .story-content p {
            margin-bottom: 1.5rem;
            position: relative;
            padding-left: 2rem;
        }
        .story-content p::before {
            content: '📖';
            position: absolute;
            left: 0;
            top: 0.2rem;
            font-size: 1.5rem;
        }
        .story-content p:nth-child(2)::before {
            content: '☕';
        }
        .story-content p.reveal {
            animation: staggerReveal 0.8s ease both;
        }
        .story-content p:nth-child(1) { animation-delay: 0.2s; }
        .story-content p:nth-child(2) { animation-delay: 0.4s; }
        @keyframes staggerReveal {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Timeline for History Section */
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #C49A6C, #A67C52);
            transform: translateX(-50%);
        }
        .timeline-item {
            position: relative;
            margin: 2rem 0;
            width: 50%;
            padding: 0 2rem;
            box-sizing: border-box;
        }
        .timeline-item:nth-child(odd) {
            left: 0;
            text-align: right;
        }
        .timeline-item:nth-child(even) {
            left: 50%;
            text-align: left;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            top: 1rem;
            width: 12px;
            height: 12px;
            background: #667eea;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #667eea;
            z-index: 1;
        }
        .timeline-item:nth-child(odd)::before {
            right: -7px;
        }
        .timeline-item:nth-child(even)::before {
            left: -7px;
        }
        .timeline-content {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .timeline-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .timeline-year {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        .timeline-text {
            line-height: 1.6;
        }
        .founder-quote {
            background: #FAF4EF;
            border-left: 5px solid #C49A6C;
            padding: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            font-size: 1.1rem;
        }
        .founder-quote::before {
            content: '"';
            font-size: 3rem;
            color: #daa520;
            position: absolute;
            margin-top: -0.5rem;
            margin-left: -1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .floating-element {
                display: none; /* Hide floating elements on mobile for better performance */
            }
            .decorative-shape {
                display: none; /* Hide decorative shapes on mobile */
            }
            .experience-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .experience-card {
                padding: 1rem;
            }
            .values-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .info-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .timeline::before {
                left: 20px;
            }
            .timeline-item {
                width: 100%;
                padding-left: 4rem;
                padding-right: 1rem;
                text-align: left !important;
            }
            .timeline-item:nth-child(odd)::before,
            .timeline-item:nth-child(even)::before {
                left: 13px;
            }
            .story-content p {
                padding-left: 1.5rem;
            }
        }


        /* Testimonials Carousel */
        .testimonials-container {
            overflow: hidden;
            width: 100%;
            position: relative;
        }
        .testimonials-track {
            display: flex;
            animation: scrollLeft 20s linear infinite;
        }
        .testimonial-card {
            flex: 0 0 300px;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-right: 2rem;
            text-align: center;
            transition: transform 0.3s;
        }
        .testimonial-card:hover {
            transform: translateY(-5px);
        }
        .testimonial-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            object-fit: cover;
        }
        .testimonial-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .testimonial-quote {
            font-style: italic;
            color: #666;
            line-height: 1.4;
        }
        @keyframes scrollLeft {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
        .testimonials-track:hover {
            animation-play-state: paused;
        }

        @media (max-width: 768px) {
            .values-radial {
                width: 400px;
                height: 400px;
            }
            .value-card-radial {
                width: 120px;
                height: 120px;
                padding: 1rem;
            }
            .value-card-radial:nth-child(1) { transform: rotate(0deg) translate(150px) rotate(0deg); }
            .value-card-radial:nth-child(2) { transform: rotate(72deg) translate(150px) rotate(-72deg); }
            .value-card-radial:nth-child(3) { transform: rotate(144deg) translate(150px) rotate(-144deg); }
            .value-card-radial:nth-child(4) { transform: rotate(216deg) translate(150px) rotate(-216deg); }
            .value-card-radial:nth-child(5) { transform: rotate(288deg) translate(150px) rotate(-288deg); }
            .testimonial-card {
                flex: 0 0 250px;
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .about-hero-content h1 {
                font-size: 2.5rem;
            }
            .about-hero-content p {
                font-size: 1rem;
            }
            .experience-card h4 {
                font-size: 1rem;
            }
            .value-card h3 {
                font-size: 1.2rem;
            }
            .story-highlight {
                padding: 1.5rem;
                font-size: 1rem;
            }
            .timeline-content {
                padding: 1rem;
            }
            .values-radial {
                width: 300px;
                height: 300px;
            }
            .value-card-radial {
                width: 100px;
                height: 100px;
                padding: 0.5rem;
            }
            .value-card-radial:nth-child(1) { transform: rotate(0deg) translate(120px) rotate(0deg); }
            .value-card-radial:nth-child(2) { transform: rotate(72deg) translate(120px) rotate(-72deg); }
            .value-card-radial:nth-child(3) { transform: rotate(144deg) translate(120px) rotate(-144deg); }
            .value-card-radial:nth-child(4) { transform: rotate(216deg) translate(120px) rotate(-216deg); }
            .value-card-radial:nth-child(5) { transform: rotate(288deg) translate(120px) rotate(-288deg); }
            .testimonial-card {
                flex: 0 0 200px;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

@include('layouts.header')

<!-- HERO ABOUT -->
<section class="about-hero">
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    <div class="about-hero-content">
        <h1>Tentang Museum Barli</h1>
        <p>Tempat di mana sejarah bertemu dengan kreativitas modern</p>
    </div>
</section>

<!-- CERITA SINGKAT -->
<section class="story-section about-section">
    <div class="decorative-shape shape-1"></div>
    <div class="container">
        <h2>Cerita Singkat</h2>
        <div class="story-content">
            <p class="reveal">Museum ini hadir sebagai ruang belajar sekaligus ruang rehat, tempat sejarah dan kopi bertemu dalam satu pengalaman. Dibangun untuk menjaga warisan budaya lokal sekaligus memberikan wadah bagi komunitas untuk berkumpul, belajar, dan menikmati seni dalam suasana yang nyaman.</p>
            <p class="reveal">Kopi bukan sekadar minuman, tapi bagian dari cerita. Coffee shop di dalam museum mencerminkan filosofi bahwa pendidikan dan relaksasi bisa berjalan beriringan, menciptakan pengalaman holistik bagi pengunjung dari berbagai kalangan.</p>
            <div class="story-highlight reveal">
                "Di Museum Barli, setiap cangkir kopi menceritakan kisah seni yang tak ternilai."
            </div>
        </div>
    </div>
</section>

<!-- SEJARAH TERBENTUKNYA MUSEUM BARLI -->
<section class="history-section about-section reveal">
    <div class="container">
        <h2 class="reveal">Sejarah Terbentuknya Museum Barli</h2>
        <div class="timeline reveal">
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-text">
                        Museum Barli didirikan sebagai inisiatif dari keluarga Barli yang memiliki passion mendalam terhadap seni dan budaya. Bermula dari koleksi pribadi yang dikumpulkan selama bertahun-tahun.
                    </div>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-text">
                        Konsep museum yang menggabungkan ruang pameran dengan coffee shop terinspirasi dari tren museum modern di Eropa, menciptakan atmosfer yang lebih inklusif dan menyenangkan.
                    </div>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-text">
                        Dengan dukungan komunitas lokal dan pemerintah daerah, Museum Barli berkembang menjadi destinasi budaya yang diminati oleh wisatawan domestik maupun mancanegara.
                    </div>
                </div>
            </div>
        </div>
        <div class="founder-quote reveal">
            "Seni bukan hanya untuk dilihat, tapi untuk dirasakan dan dibagikan. Museum Barli lahir dari keinginan untuk membuat budaya lebih dekat dengan masyarakat." - Keluarga Barli
        </div>
    </div>
</section>

<!-- PENGALAMAN PENGUNJUNG -->
<section class="about-section reveal" style="background: #f8f9fa;">
    <div class="container">
        <h2 class="reveal">Pengalaman Pengunjung</h2>
        <p class="reveal" style="text-align: center; margin-bottom: 3rem; font-size: 1.1rem;">Apa yang dikatakan pengunjung tentang Museum Barli?</p>
        <div class="testimonials-container">
            <div class="testimonials-track">
                <div class="testimonial-card">
                    <img src="{{ asset('foto/potrait.png') }}" alt="Ahmad S." class="testimonial-photo">
                    <div class="testimonial-name">Ahmad S.</div>
                    <div class="testimonial-quote">"Museum Barli memberikan pengalaman yang luar biasa. Koleksi seninya sangat menginspirasi, dan coffee shopnya membuat kunjungan semakin menyenangkan."</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('foto/potrait2.png') }}" alt="Siti R." class="testimonial-photo">
                    <div class="testimonial-name">Siti R.</div>
                    <div class="testimonial-quote">"Sebagai pecinta seni, saya sangat terkesan dengan kurasi pameran di sini. Tempatnya nyaman dan edukatif untuk semua usia."</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('foto/potrait3.png') }}" alt="Budi K." class="testimonial-photo">
                    <div class="testimonial-name">Budi K.</div>
                    <div class="testimonial-quote">"Kunjungan ke Museum Barli selalu menjadi highlight liburan saya. Seni dan kopi yang sempurna!"</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('foto/square.png') }}" alt="Maya L." class="testimonial-photo">
                    <div class="testimonial-name">Maya L.</div>
                    <div class="testimonial-quote">"Tempat yang indah untuk belajar tentang budaya lokal. Workshopnya sangat interaktif dan menyenangkan."</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('foto/square2.png') }}" alt="Rizki A." class="testimonial-photo">
                    <div class="testimonial-name">Rizki A.</div>
                    <div class="testimonial-quote">"Museum Barli berhasil menggabungkan seni dan relaksasi dengan sempurna. Saya pasti akan kembali lagi."</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('foto/square3.png') }}" alt="Nina P." class="testimonial-photo">
                    <div class="testimonial-name">Nina P.</div>
                    <div class="testimonial-quote">"Pengalaman yang tak terlupakan. Dari pameran hingga coffee shop, semuanya luar biasa."</div>
                </div>
                <!-- Duplicate for seamless loop -->
                <div class="testimonial-card">
                    <img src="{{ asset('foto/potrait.png') }}" alt="Ahmad S." class="testimonial-photo">
                    <div class="testimonial-name">Ahmad S.</div>
                    <div class="testimonial-quote">"Museum Barli memberikan pengalaman yang luar biasa. Koleksi seninya sangat menginspirasi, dan coffee shopnya membuat kunjungan semakin menyenangkan."</div>
                </div>
                <div class="testimonial-card">
                    <img src="{{ asset('foto/potrait2.png') }}" alt="Siti R." class="testimonial-photo">
                    <div class="testimonial-name">Siti R.</div>
                    <div class="testimonial-quote">"Sebagai pecinta seni, saya sangat terkesan dengan kurasi pameran di sini. Tempatnya nyaman dan edukatif untuk semua usia."</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- INFORMASI PRAKTIS -->
<section class="about-section reveal">
    <div class="container">
        <h2 class="reveal">Informasi Praktis</h2>
        <div class="info-grid reveal">
            <div class="info-card reveal">
                <h3><span class="card-icon">📍</span>Lokasi</h3>
                <p>Jl. Prof. Dr. Sutami No.91, Sukarasa,<br>
                Kec. Sukasari, Kota Bandung,<br>
                Jawa Barat 40152</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.902!2d107.579!3d-6.914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6b8b8b8b8b8%3A0x2e68e6b8b8b8b8b8!2sJl.%20Prof.%20Dr.%20Sutami%20No.91%2C%20Sukarasa%2C%20Kec.%20Sukasari%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040152!5e0!3m2!1sen!2sid!4v1690000000000!5m2!1sen!2sid" width="100%" height="200" style="border:0; border-radius: 10px; margin-top: 1rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="info-card reveal">
                <h3><span class="card-icon">🕒</span>Jam Operasional</h3>
                <p><strong>Museum:</strong><br>
                Senin - Jumat: 09.00 - 17.00 WIB<br>
                Sabtu - Minggu: 10.00 - 18.00 WIB<br><br>
                <strong>Coffee Shop:</strong><br>
                Senin - Minggu: 08.00 - 20.00 WIB</p>
            </div>
            <div class="info-card reveal">
                <h3><span class="card-icon">📞</span>Kontak & Media Sosial</h3>
                <p><strong>Telepon:</strong> <a href="tel:+62222011889">(022) 2011889</a><br>
                <strong>Email:</strong> <a href="mailto:info@museum-barli.com">info@museum-barli.com</a><br><br>
                <strong>Ikuti Kami:</strong></p>
                <div class="social-links">
                    <a href="https://www.instagram.com/museumbarli" target="_blank" class="social-link instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/museumbarli" target="_blank" class="social-link facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

<script src="{{ url('js/home.js') }}"></script>
</body>
</html>
