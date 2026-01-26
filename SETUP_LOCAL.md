# 🚀 Setup Guide untuk Developer Lokal

## Persiapan Awal

### 1. Clone Repository
```bash
git clone <repository-url>
cd Artefacta
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=museum_db
DB_USERNAME=root
DB_PASSWORD=
```

**Pastikan MySQL berjalan di XAMPP**

### 5. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 6. Setup Storage Link
```bash
php artisan storage:link
```
Ini membuat symbolic link dari `storage/app/public` ke `public/storage`

### 7. Jalankan Server
```bash
php artisan serve
```

Akses di: http://127.0.0.1:8000

---

## 📁 Struktur Folder Penting

- `/storage/app/public/galleries/` - Foto gallery yang di-upload
- `/storage/app/public/menus/` - Foto menu yang di-upload  
- `/public/foto/` - Foto statis coffeeshop
- `/public/storage` - Symbolic link ke storage/app/public

## 🔐 Catatan Keamanan

- **File `.env` diabaikan dari Git** - Setup sendiri di lokal Anda
- **File `*.key` diabaikan dari Git** - Generate dengan `php artisan key:generate`
- **Folder `vendor/` dan `node_modules/` diabaikan** - Install dengan composer/npm

## 👥 Fitur Utama

- **Admin Dashboard**: http://127.0.0.1:8000/login
- **Public Website**: http://127.0.0.1:8000/
- **Gallery Management**: Admin → Galleries
- **Menu Management**: Admin → Menus
- **Artifact Management**: Admin → Artifacts

## ❓ Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "No application key detected"
```bash
php artisan key:generate
```

### Error: "Storage link not found"
```bash
php artisan storage:link
```

### Database tidak terkoneksi
- Pastikan MySQL berjalan
- Periksa konfigurasi `.env` (DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD)

---

**Setiap developer harus menjalankan langkah-langkah di atas di mesin lokal mereka.**
