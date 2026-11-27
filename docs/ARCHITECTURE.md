# Architecture: Jadwal Security

## Bentuk aplikasi

Laravel 13 monolitik dengan Blade, PostgreSQL, dan Docker Compose. Tidak ada API atau frontend terpisah.

## Komponen

```text
Browser
  -> Laravel app (port 8080 lokal)
       -> Blade: jadwal publik dan editor admin
       -> PostgreSQL: users, security_officers, schedule_assignments
```

## Data

- `users`: akun admin melalui kolom `is_admin`.
- `security_officers`: nama, lokasi basis, dan status aktif.
- `schedule_assignments`: satu baris per petugas per tanggal; unique index memaksa aturan tersebut.

## Keamanan dan operasi

- Admin dilindungi middleware `auth` dan pemeriksaan `is_admin` di controller.
- Login dibatasi lima percobaan per email dan IP dalam satu menit.
- Password dan credential hanya berada di `.env`, yang tidak dilacak Git.
- PostgreSQL memakai named volume. Migration serta seed adalah langkah eksplisit, bukan startup container.
- Test berjalan melalui `docker compose run --rm test` dengan SQLite in-memory; service tersebut tidak terhubung ke PostgreSQL lokal.
