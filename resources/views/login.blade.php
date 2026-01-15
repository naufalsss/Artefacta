<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar & Login - Museum</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="auth-wrapper">
            <!-- Header -->
            <div class="auth-header">
                <h1 id="headerTitle">Masuk ke Museum</h1>
                <p id="headerSubtitle">Silakan masukkan email dan password Anda</p>
            </div>

            <!-- Form Login (Default/Tampil Duluan) -->
            <form id="loginForm" class="auth-form active" method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="login_email">Email <span class="required">*</span></label>
                    <input 
                        type="email" 
                        id="login_email" 
                        name="email" 
                        placeholder="contoh: nama@gmail.com"
                        required
                        autocomplete="email"
                    >
                    <span class="error-message" id="error-login_email"></span>
                </div>

                <div class="form-group">
                    <label for="login_password">Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="login_password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-password" data-target="login_password">
                            <span class="eye-icon">👁️</span>
                        </button>
                    </div>
                    <span class="error-message" id="error-login_password"></span>
                </div>

                <button type="submit" class="submit-btn" id="loginBtn">
                    <span class="btn-text">Masuk</span>
                    <span class="btn-loader" style="display: none;">⏳ Memproses...</span>
                </button>

                <div class="switch-link">
                    <button type="button" class="link-btn" id="switchToDaftar">
                        Belum punya akun? <span class="link-text">Daftar</span>
                    </button>
                </div>
            </form>

            <!-- Form Daftar -->
            <form id="daftarForm" class="auth-form" method="POST" action="{{ route('daftar') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nama <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        placeholder="Masukkan nama lengkap Anda"
                        required
                        autocomplete="name"
                    >
                    <span class="error-message" id="error-name"></span>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <span class="error-message" id="error-jenis_kelamin"></span>
                </div>

                <div class="form-group">
                    <label for="umur">Umur <span class="required">*</span></label>
                    <input 
                        type="number" 
                        id="umur" 
                        name="umur" 
                        placeholder="Masukkan umur Anda"
                        min="1"
                        max="120"
                        required
                    >
                    <span class="error-message" id="error-umur"></span>
                </div>

                <div class="form-group">
                    <label for="status">Status <span class="required">*</span></label>
                    <select id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Pelajar">Pelajar</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Pekerja">Pekerja</option>
                        <option value="Pensiunan">Pensiunan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <span class="error-message" id="error-status"></span>
                </div>

                <div class="form-group">
                    <label for="daftar_email">Email <span class="required">*</span></label>
                    <input 
                        type="email" 
                        id="daftar_email" 
                        name="email" 
                        placeholder="contoh: nama@gmail.com"
                        required
                        autocomplete="email"
                    >
                    <span class="error-message" id="error-daftar_email"></span>
                </div>

                <div class="form-group">
                    <label for="daftar_password">Password <span class="required">*</span></label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="daftar_password" 
                            name="password" 
                            placeholder="Masukkan password Anda (min 6 karakter)"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="toggle-password" data-target="daftar_password">
                            <span class="eye-icon">👁️</span>
                        </button>
                    </div>
                    <span class="error-message" id="error-daftar_password"></span>
                </div>

                <button type="submit" class="submit-btn" id="daftarBtn">
                    <span class="btn-text">Daftar</span>
                    <span class="btn-loader" style="display: none;">⏳ Memproses...</span>
                </button>

                <div class="switch-link">
                    <button type="button" class="link-btn" id="switchToLogin">
                        Sudah punya akun? <span class="link-text">Login</span>
                    </button>
                </div>
            </form>

            <div class="auth-footer">
                <p>Dengan melanjutkan, Anda menyetujui ketentuan penggunaan museum</p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
