# Fitur Gallery CRUD - Dokumentasi

## 📋 Ringkasan
Sistem Gallery yang telah diimplementasikan memungkinkan admin mengelola galeri melalui dashboard dengan fitur-fitur sebagai berikut:

## ✨ Fitur Utama

### 1. **Admin Dashboard Gallery Management**
- **Lokasi**: `/dashboard` → Click "Manage Galleries"
- **CRUD Operations**: Create, Read, Update, Delete gallery items
- **Hanya Admin**: Diproteksi dengan middleware `admin`
- **Fitur**:
  - Create: Tambah gallery item baru dengan gambar
  - Edit: Ubah informasi dan gambar gallery
  - Delete: Hapus gallery item
  - Publish/Draft: Toggle status publikasi ke halaman publik

### 2. **Gallery Item Schema**
Setiap gallery item memiliki:
- `title` - Judul gallery
- `description` - Deskripsi detail
- `image_path` - Path gambar yang di-upload
- `artifact_id` - Relasi ke artifact (opsional)
- `is_published` - Status publikasi (false = draft, true = public)
- `timestamps` - Created at & Updated at

### 3. **Public Gallery Page**
- **URL**: `/galleries`
- **Akses**: Publik (tidak perlu login)
- **Konten**: Hanya menampilkan gallery items dengan `is_published = true`
- **Layout**: Menggunakan header & footer yang sama dengan halaman home
- **Fitur**:
  - Grid gallery dengan preview gambar
  - Pagination untuk navigasi
  - Menampilkan artifact yang terkait (jika ada)
  - Responsive design

## 🗂️ File-file Yang Dibuat/Diubah

### Controllers
- `app/Http/Controllers/GalleryController.php` - CRUD + public gallery

### Models
- `app/Models/Gallery.php` - Model dengan relasi ke Artifact
- `app/Models/Artifact.php` - Ditambah relasi hasMany galleries

### Views
**Dashboard (Admin Only)**:
- `resources/views/galleries/index.blade.php` - List gallery items
- `resources/views/galleries/create.blade.php` - Form create
- `resources/views/galleries/edit.blade.php` - Form edit
- `resources/views/galleries/show.blade.php` - Detail gallery
- `resources/views/galleries/_form.blade.php` - Shared form partial

**Public**:
- `resources/views/galleries/published.blade.php` - Public gallery page dengan header/footer home

**Layout Components**:
- `resources/views/layouts/header.blade.php` - Header reusable
- `resources/views/layouts/footer.blade.php` - Footer reusable

### Routes
- `routes/web.php` - Ditambah:
  - `GET /galleries` - Public gallery page
  - `Route::resource('galleries', GalleryController::class)` - Admin CRUD

### Migrations
- `database/migrations/2026_01_21_104010_create_galleries_table.php` - Schema update dengan kolom baru

## 🔐 Access Control

| Route | Method | Akses | Deskripsi |
|-------|--------|-------|-----------|
| `/galleries` | GET | Publik | Tampilkan gallery yang dipublish |
| `/galleries` | GET | Admin | List semua gallery (admin dashboard) |
| `/galleries/create` | GET | Admin | Form create |
| `/galleries/{id}` | GET | Admin | Detail item di dashboard |
| `/galleries/{id}/edit` | GET | Admin | Form edit |
| `/galleries` | POST | Admin | Simpan gallery baru |
| `/galleries/{id}` | PUT | Admin | Update gallery |
| `/galleries/{id}` | DELETE | Admin | Hapus gallery |

## 📝 Cara Penggunaan

### Untuk Admin:
1. Login ke dashboard
2. Klik "Manage Galleries" di card Galleries
3. Klik "Add New Gallery Item"
4. Isi form:
   - Title (required)
   - Description (optional)
   - Image (optional, max 2MB)
   - Associated Artifact (optional dropdown)
   - Publish checkbox (untuk publish ke halaman publik)
5. Klik "Create Gallery Item"

### Untuk Publik:
1. Buka `/galleries` atau klik "Galeri" di navbar home page
2. Lihat gallery items yang sudah di-publish
3. Gambar ditampilkan dalam grid yang rapi
4. Info artifact terkait ditampilkan

## 🎨 Design Features

### Public Gallery Page
- Header dan footer sama dengan home page
- Hero section dengan tema gallery
- Grid layout responsif
- Hover animation pada card
- Pagination untuk navigasi
- Empty state jika tidak ada gallery

### Admin Dashboard
- Bootstrap styling konsisten
- Form validation dengan error messages
- Status badge (Published/Draft)
- Quick actions (View, Edit, Delete)
- Pagination untuk list

## 🚀 Running the Application

### Update Database
```bash
php artisan migrate:refresh
```

### Start Server
```bash
php artisan serve
```

Akses:
- Dashboard: `http://localhost:8000/dashboard`
- Public Gallery: `http://localhost:8000/galleries`
- Home: `http://localhost:8000/`
