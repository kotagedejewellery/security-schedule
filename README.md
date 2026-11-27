# Jadwal Security

Satu aplikasi Laravel sederhana untuk melihat jadwal security dan mengelolanya sebagai admin.

- Publik: `http://localhost:8080/`
- Admin: `http://localhost:8080/admin/login`

## Menjalankan lokal

Prasyarat: Docker Desktop berjalan.

1. Salin `.env.example` menjadi `.env`, lalu isi `DB_PASSWORD`, `ADMIN_EMAIL`, dan `ADMIN_PASSWORD`.
2. Jalankan `docker compose up -d --build`.
3. Buat application key sekali: `docker compose exec app php artisan key:generate`.
4. Jalankan migration secara eksplisit: `docker compose exec app php artisan migrate`.
5. Tambahkan data awal secara eksplisit: `docker compose exec app php artisan db:seed --class=DatabaseSeeder`.

Seeder bersifat idempoten: ia menambahkan empat petugas awal bila belum ada. Jangan memakai `migrate:fresh`, `db:wipe`, atau `docker compose down -v` pada data yang ingin dipertahankan.

## Operasional

- Jadwal publik dapat dibuka tanpa login.
- Hanya user dengan `is_admin=true` yang dapat membuka dan menyimpan `/admin/jadwal`.
- Migration dan seed tidak dijalankan otomatis saat container mulai.
- Waktu aplikasi memakai `Asia/Jakarta`.

## Test

Test menggunakan service terpisah dengan SQLite in-memory, bukan PostgreSQL lokal:

```text
docker compose run --rm test
```

## Cek mobile sebelum rilis

Pada Android atau iPhone, buka halaman publik dan admin lalu pastikan tabel dapat digeser horizontal, kolom tanggal tetap terlihat, dan tombol simpan tetap mudah dijangkau.

## Deployment VPS 1

Konfigurasi produksi memakai Traefik dan network `proxy` yang sudah tersedia di VPS. Langkah bootstrap, environment, migration terkontrol, dan GitHub Actions ada di [docs/DEPLOYMENT-VPS1.md](docs/DEPLOYMENT-VPS1.md).
