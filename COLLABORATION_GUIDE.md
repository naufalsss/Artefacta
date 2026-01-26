# 📋 Panduan Kolaborasi Tim - Artefacta

## Masalah dan Solusi

### Masalah
File uploads (foto gallery, menu, etc) tidak ter-upload ke GitHub karena diabaikan di `.gitignore`.

### Solusi yang Diterapkan

1. ✅ **Update `.gitignore`** - Sekarang file uploads DITRACK di Git
2. ✅ **Hapus folder diabaikan** - Folder uploads sekarang bisa di-push
3. ✅ **Buat setup guide** - File `SETUP_LOCAL.md` untuk setup lokal

---

## 📥 Untuk Rekan Kerja yang Clone Repository

### Step 1: Clone Repository
```bash
git clone <url-repository>
cd Artefacta
```

### Step 2: Setup Environment
```bash
# Copy example env
cp .env.example .env

# Generate key
php artisan key:generate

# Edit .env dengan konfigurasi lokal
# - DB_HOST
# - DB_DATABASE
# - DB_USERNAME
# - DB_PASSWORD
```

### Step 3: Install Dependencies
```bash
composer install
npm install
```

### Step 4: Setup Database
```bash
# Jalankan migration
php artisan migrate

# (Optional) Jalankan seeder untuk data awal
php artisan db:seed
```

### Step 5: Setup Storage Link
```bash
php artisan storage:link
```

### Step 6: Jalankan Server
```bash
php artisan serve
```

---

## 🎯 File dan Folder yang Sekarang Di-Track

### Folder Uploads (Disimpan di Git)
- `storage/app/public/galleries/` - Foto gallery
- `storage/app/public/menus/` - Foto menu
- `storage/app/public/artifacts/` - Foto artifact

### Folder Statis (Disimpan di Git)
- `public/foto/` - Foto background coffeeshop

### Struktur yang Akan Dibuat Otomatis
- `public/storage` - Symbolic link (dibuat dengan `php artisan storage:link`)

---

## 🔐 File yang TIDAK Di-Track (Sensitive)

```
.env                 ← Environment variables (DB password, API keys)
storage/*.key        ← Application encryption key
vendor/              ← Composer dependencies
node_modules/        ← NPM dependencies
public/build         ← Build output
```

**Setiap developer membuat file-file ini di lokal mereka sendiri.**

---

## 📤 Push Perubahan ke Repository

### Workflow Standar

```bash
# 1. Buat fitur baru di branch
git checkout -b feature/nama-fitur

# 2. Buat perubahan + upload foto
# (Foto akan otomatis tersimpan di storage/app/public/*)

# 3. Commit semua perubahan (termasuk foto)
git add .
git commit -m "feat: tambah gallery baru dengan foto"

# 4. Push ke repository
git push origin feature/nama-fitur

# 5. Buat Pull Request dan tunggu review
```

### Contoh Push dengan Foto
```bash
git add storage/app/public/galleries/foto-baru.jpg
git add app/Models/Gallery.php
git commit -m "feat: tambah gallery item dengan foto"
git push origin feature/new-gallery
```

---

## ✅ Checklist untuk Rekan Kerja

- [ ] Clone repository
- [ ] Copy `.env.example` ke `.env`
- [ ] Run `php artisan key:generate`
- [ ] Edit `.env` dengan DB credentials lokal
- [ ] Run `composer install`
- [ ] Run `npm install`
- [ ] Run `php artisan migrate`
- [ ] Run `php artisan storage:link`
- [ ] Run `php artisan serve`
- [ ] Test akses ke http://127.0.0.1:8000

---

## 🚀 Tips untuk Kolaborasi Lancar

### Sebelum Push
1. Pull latest changes: `git pull origin main`
2. Jalankan migration: `php artisan migrate`
3. Test aplikasi lokal
4. Commit dengan pesan deskriptif

### Jika ada Konflik
```bash
# Resolusi konflik, lalu
git add .
git commit -m "resolve: merge conflict dari main"
git push
```

### Update Database Schema
Jika ada migration baru di repository:
```bash
git pull origin main
php artisan migrate
```

---

## 📞 Troubleshooting

| Error | Solusi |
|-------|--------|
| `Class not found` | Run `composer dump-autoload` |
| `No application key` | Run `php artisan key:generate` |
| `SQLSTATE connection error` | Pastikan MySQL running dan `.env` benar |
| `Storage not found` | Run `php artisan storage:link` |
| `File permission denied` | Jalankan: `php artisan cache:clear` |

---

## 📝 Catatan Penting

- **Jangan commit `.env`** - File ini diabaikan karena berisi password
- **Jangan commit `vendor/`** - Dependencies diinstall dari `composer.json`
- **Jangan commit `node_modules/`** - Dependencies diinstall dari `package.json`
- **Upload foto ke folder `/storage/app/public/`** - Path otomatis di-track Git
- **Selalu sync dengan main branch** - Sebelum mulai fitur baru

---

Good luck! 🚀
