# 🗄️ Panduan Menyamakan Database

Jika Anda ingin database partner memiliki isi yang SAMA dengan database Anda, ada 3 cara:

## **Cara 1: Database Dump (PALING MUDAH & CEPAT)**

### Di Laptop Anda (Developer yang sudah ada data):

```bash
# Export database ke file SQL
mysqldump -u root -p museum_db > museum_db_backup.sql
```

Setelah itu, push file `museum_db_backup.sql` ke repository:

```bash
git add museum_db_backup.sql
git commit -m "chore: add database dump for team synchronization"
git push origin main
```

### Di Laptop Partner:

```bash
# 1. Setelah clone repository
git pull origin main

# 2. Import database dump
mysql -u root -p museum_db < museum_db_backup.sql

# Atau jika belum ada database:
mysql -u root -p -e "CREATE DATABASE museum_db;"
mysql -u root -p museum_db < museum_db_backup.sql

# 3. Jalankan server
php artisan serve
```

**Keuntungan:** 
- ✅ Paling cepat dan mudah
- ✅ Semua data langsung tersinkronisasi

**Kekurangan:**
- ⚠️ Perlu update manual setiap ada perubahan data

---

## **Cara 2: Database Seeder (RECOMMENDED)**

Saat ini sudah ada `DataSeeder.php` di repository yang berisi:
- 1 Artifact (LUKISAN)
- 3 Gallery items dengan foto

### Cara Partner Menggunakan:

```bash
# Setelah setup awal (migrate)
php artisan db:seed
```

Atau seeding spesifik:

```bash
php artisan db:seed --class=DataSeeder
```

**Keuntungan:**
- ✅ Otomatis dan bisa di-versionkan di Git
- ✅ Konsisten untuk semua developer
- ✅ Mudah update data (edit di `DataSeeder.php` lalu commit)

**Kekurangan:**
- ⚠️ Perlu update `DataSeeder.php` setiap ada data baru

---

## **Cara 3: Database Link (Advanced)**

Menggunakan database shared di server (untuk production):

```bash
# Tidak cocok untuk development lokal
# Hanya untuk shared staging/production environment
```

---

## 📋 Rekomendasi Workflow untuk Tim:

### **Untuk sekarang (Development Phase):**
✅ **Gunakan Cara 2 (Seeder)** - Saya sudah buatkan `DataSeeder.php`

```bash
php artisan migrate
php artisan db:seed
```

### **Untuk production atau sharing data berat:**
✅ **Gunakan Cara 1 (Dump)** - Paling praktis

---

## 🔄 Update DataSeeder untuk Data Baru

Jika Anda tambah data baru dan ingin share ke partner:

1. **Update `DataSeeder.php`** di laptop Anda dengan data baru
2. **Commit dan Push:**
   ```bash
   git add database/seeders/DataSeeder.php
   git commit -m "chore: update data seeder dengan data terbaru"
   git push origin main
   ```

3. **Di laptop Partner:**
   ```bash
   git pull origin main
   php artisan db:seed --class=DataSeeder
   ```

---

## ✅ Checklist Sinkronisasi Database:

- [ ] Developer 1 push data ke repository
- [ ] Developer 2 pull repository
- [ ] Developer 2 jalankan `php artisan migrate`
- [ ] Developer 2 jalankan `php artisan db:seed`
- [ ] Developer 2 akses admin dan verifikasi data ada

---

**Catatan Penting:**
- Database tidak akan sinkronisasi otomatis
- Perlu manual sync menggunakan salah satu cara di atas
- User yang dibuat dengan `UserFactory` akan berbeda setiap kali seed
- Untuk menggunakan data yang sama termasuk credentials, gunakan Cara 1 (Dump)
