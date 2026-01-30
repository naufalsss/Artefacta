<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Pemesanan - Artefacta Coffee</title>
</head>
<body>

@include('layouts.header')

<!-- HERO / INTRO PEMESANAN -->
<section class="booking-hero">
    <div class="booking-hero-overlay"></div>
    <div class="booking-hero-content">
        <h1 class="booking-hero-title">Rencanakan Kunjunganmu</h1>
        <p class="booking-hero-subtitle">
            Pesan tiket museum dan nikmati coffee shop dalam satu pengalaman.
        </p>
    </div>
    <div class="booking-hero-images">
        <img src="{{ asset('foto/cafebarli.png') }}" alt="Museum & Coffee Shop" class="hero-bg-image">
    </div>
</section>

<!-- STEP NAVIGATION -->
<section class="step-navigation">
    <div class="step-container">
        <div class="step-item" data-step="1">
            <span class="step-number">1</span>
            <span class="step-label">Tiket</span>
        </div>
        <div class="step-line"></div>
        <div class="step-item" data-step="2">
            <span class="step-number">2</span>
            <span class="step-label">Coffee Shop</span>
        </div>
        <div class="step-line"></div>
        <div class="step-item active" data-step="3">
            <span class="step-number">3</span>
            <span class="step-label">Ringkasan</span>
        </div>
    </div>
</section>

<!-- SECTION A — PEMESANAN TIKET MUSEUM -->
<section class="booking-section active" id="step-1">
    <div class="booking-container">

        <!-- PILIH JENIS TIKET -->
        <div class="ticket-selection">
            <h2 class="section-title">Pilih Jenis Tiket</h2>
            <div class="ticket-grid">
                <div class="ticket-card" data-ticket="reguler">
                    <div class="ticket-header">
                        <h3>Tiket Reguler</h3>
                        <div class="ticket-price">Rp 50.000</div>
                    </div>
                    <p class="ticket-description">Akses penuh ke semua koleksi museum dan area coffee shop.</p>
                    <div class="quantity-controls">
                        <button class="qty-btn minus">-</button>
                        <input type="number" class="qty-input" value="0" min="0" max="10">
                        <button class="qty-btn plus">+</button>
                    </div>
                </div>

                <div class="ticket-card" data-ticket="pelajar">
                    <div class="ticket-header">
                        <h3>Tiket Pelajar</h3>
                        <div class="ticket-price">Rp 30.000</div>
                    </div>
                    <p class="ticket-description">Diskon khusus untuk pelajar dengan kartu identitas.</p>
                    <div class="quantity-controls">
                        <button class="qty-btn minus">-</button>
                        <input type="number" class="qty-input" value="0" min="0" max="10">
                        <button class="qty-btn plus">+</button>
                    </div>
                </div>

                <div class="ticket-card" data-ticket="keluarga">
                    <div class="ticket-header">
                        <h3>Tiket Keluarga</h3>
                        <div class="ticket-price">Rp 150.000</div>
                    </div>
                    <p class="ticket-description">Untuk 2 dewasa dan 2 anak, akses penuh ke museum dan coffee shop.</p>
                    <div class="quantity-controls">
                        <button class="qty-btn minus">-</button>
                        <input type="number" class="qty-input" value="0" min="0" max="10">
                        <button class="qty-btn plus">+</button>
                    </div>
                </div>

                <div class="ticket-card" data-ticket="special">
                    <div class="ticket-header">
                        <h3>Special Exhibition</h3>
                        <div class="ticket-price">Rp 75.000</div>
                    </div>
                    <p class="ticket-description">Akses eksklusif ke pameran khusus dengan guided tour.</p>
                    <div class="quantity-controls">
                        <button class="qty-btn minus">-</button>
                        <input type="number" class="qty-input" value="0" min="0" max="10">
                        <button class="qty-btn plus">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TANGGAL & JAM KUNJUNGAN -->
        <div class="datetime-selection">
            <h2 class="section-title">Tanggal & Jam Kunjungan</h2>
            <div class="datetime-grid">
                <div class="datetime-field">
                    <label for="visit-date">Tanggal Kunjungan</label>
                    <input type="date" id="visit-date" name="visit_date" min="{{ date('Y-m-d') }}">
                </div>
                <div class="datetime-field">
                    <label for="visit-time">Jam Kunjungan</label>
                    <select id="visit-time" name="visit_time">
                        <option value="">Pilih Jam</option>
                        <option value="09:00">09:00 - 11:00</option>
                        <option value="11:00">11:00 - 13:00</option>
                        <option value="13:00">13:00 - 15:00</option>
                        <option value="15:00">15:00 - 17:00</option>
                        <option value="17:00">17:00 - 19:00</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- DATA PEMESAN -->
        <div class="customer-data">
            <h2 class="section-title">Data Pemesan</h2>
            <div class="customer-form">
                <div class="form-row">
                    <div class="form-field">
                        <label for="customer-name">Nama Pemesan</label>
                        <input type="text" id="customer-name" name="customer_name" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-field">
                        <label for="customer-phone">Nomor WhatsApp</label>
                        <input type="tel" id="customer-phone" name="customer_phone" placeholder="081234567890">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="customer-email">Email (Opsional)</label>
                        <input type="email" id="customer-email" name="customer_email" placeholder="email@example.com">
                    </div>
                </div>
            </div>
        </div>

        <!-- NEXT BUTTON -->
        <div class="section-actions">
            <button class="btn-next" id="next-to-coffee">Lanjut ke Coffee Shop</button>
        </div>

    </div>
</section>

<!-- SECTION B — KERANJANG COFFEE SHOP -->
<section class="booking-section" id="step-2">
    <div class="booking-container">
        <!-- INTRO CART -->
        <div class="cart-intro">
            <h2 class="section-title">Keranjang Pesanan Coffee Shop</h2>
            <p class="section-description">Menu yang telah Anda tambahkan dari halaman Coffee Shop.</p>
        </div>

        <!-- CART ITEMS -->
        <div class="cart-items" id="cart-items">
            <!-- Cart items will be populated by JavaScript -->
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Keranjang Kosong</h3>
                <p>Belum ada menu yang ditambahkan. Kunjungi halaman Coffee Shop untuk menambah menu ke keranjang.</p>
                <a href="/coffeeshop" class="btn-primary">Kunjungi Coffee Shop</a>
            </div>
        </div>

        <!-- CART SUMMARY -->
        <div class="cart-summary" id="cart-summary" style="display: none;">
            <div class="cart-total">
                <div class="total-row">
                    <span>Total Coffee Shop</span>
                    <span id="cart-total-price">Rp 0</span>
                </div>
            </div>
        </div>

        <!-- CATATAN PESANAN -->
        <div class="order-notes">
            <h3>Catatan Pesanan (Opsional)</h3>
            <textarea id="order-notes" placeholder="Contoh: Kurang gula, Ambil jam 11.00" rows="3"></textarea>
        </div>

        <!-- NAVIGATION BUTTONS -->
        <div class="section-actions">
            <button class="btn-prev" id="back-to-tickets">Kembali ke Tiket</button>
            <button class="btn-next" id="next-to-summary">Lihat Ringkasan Pesanan</button>
        </div>
    </div>
</section>

<!-- SECTION C — RINGKASAN & KONFIRMASI -->
<section class="booking-section" id="step-3">
    <div class="booking-container">

        <!-- RINGKASAN TIKET -->
        <div class="summary-section">
            <h3>Ringkasan Tiket</h3>
            <div class="summary-card">
                <div class="summary-info" id="summary-date-time">
                    <!-- Date and time will be populated by JavaScript -->
                </div>
                <div class="summary-info" id="summary-customer">
                    <!-- Customer info will be populated by JavaScript -->
                </div>
                <div class="summary-info" id="summary-notes">
                    <!-- Notes will be populated by JavaScript -->
                </div>
                <ul class="summary-list" id="summary-ticket-list">
                    <!-- Ticket items will be populated by JavaScript -->
                </ul>
                <div class="summary-subtotal" id="summary-ticket-subtotal">
                    <!-- Ticket subtotal will be populated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- RINGKASAN COFFEE SHOP -->
        <div class="summary-section">
            <h3>Ringkasan Coffee Shop</h3>
            <div class="summary-card">
                <ul class="summary-list" id="summary-coffee-list">
                    <!-- Coffee items will be populated by JavaScript -->
                </ul>
                <div class="summary-subtotal" id="summary-coffee-subtotal">
                    <!-- Coffee subtotal will be populated by JavaScript -->
                </div>
            </div>
        </div>

        <!-- TOTAL KESELURUHAN -->
        <div class="summary-total">
            <div class="total-row">
                <span>Total Keseluruhan</span>
                <span id="summary-grand-total">Rp 0</span>
            </div>
        </div>

        <!-- METODE PEMBAYARAN -->
        <div class="payment-section">
            <h3>Metode Pembayaran</h3>
            <div class="payment-options">
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="tempat" checked>
                    <span class="payment-label">
                        <i class="fas fa-cash-register"></i>
                        Bayar di Tempat
                    </span>
                </label>
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="transfer">
                    <span class="payment-label">
                        <i class="fas fa-university"></i>
                        Transfer Bank
                    </span>
                </label>
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="qris">
                    <span class="payment-label">
                        <i class="fas fa-qrcode"></i>
                        QRIS
                    </span>
                </label>
            </div>
        </div>

        <!-- KONFIRMASI PESANAN -->
        <div class="confirmation-section">
            <label class="terms-checkbox">
                <input type="checkbox" id="agree-terms">
                <span class="checkmark"></span>
                Saya menyetujui syarat & ketentuan
            </label>
        </div>

        <!-- NAVIGATION BUTTONS -->
        <div class="section-actions">
            <button class="btn-prev" id="back-to-coffee">Kembali ke Coffee Shop</button>
            <button class="btn-primary" id="confirm-booking">Konfirmasi Pemesanan</button>
        </div>

    </div>
</section>

@include('layouts.footer')

<script src="{{ asset('js/booking.js') }}"></script>
</body>
</html>

