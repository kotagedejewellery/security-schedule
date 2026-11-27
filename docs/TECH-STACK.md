# Usulan Tech Stack — Security Schedule MVP

Status: proposal, 24 November 2026.

## Keputusan

Gunakan **Laravel 13 + Blade + sedikit Alpine.js + Tailwind CSS + PostgreSQL + Docker Compose** sebagai satu aplikasi monolitik. Tidak perlu API terpisah, SPA, atau dashboard.

Ini adalah pilihan paling kecil yang tetap lengkap untuk dua kebutuhan inti:

1. Halaman publik `/` untuk melihat jadwal bulanan seluruh petugas.
2. Halaman privat `/admin/jadwal` untuk admin mengelola jadwal, tanpa dashboard, statistik, atau modul lain.

Laravel 13 menyediakan middleware `auth` untuk melindungi rute dan Gate/policy untuk otorisasi aksi. Starter kit resminya menyediakan autentikasi siap pakai; gunakan hanya login dan reset kata sandi, nonaktifkan registrasi publik. [Laravel authentication](https://laravel.com/framework/docs/13.x/authentication) · [Laravel authorization](https://laravel.com/framework/docs/13.x/authorization) · [Laravel starter kits](https://laravel.com/starter-kits)

### Bentuk aplikasi

| Lapisan | Pilihan | Alasan |
| --- | --- | --- |
| Web + backend | Laravel 13, PHP 8.3+ | Satu codebase untuk halaman publik, login, validasi, dan admin. Tidak perlu API terpisah. |
| Tampilan | Blade + Tailwind CSS | Jadwal adalah tabel/form operasional; render server-side sederhana, cepat, dan mudah dipelihara. |
| Interaksi kecil | Alpine.js bawaan starter | Hanya untuk pemilih bulan, konfirmasi hapus, atau filter visual; tidak memakai SPA. |
| Akses admin | Laravel starter-kit authentication + satu `is_admin` pada `users` + Gate `manage-schedule` | Login rate-limited tersedia dari starter kit dan Gate menjaga seluruh mutasi jadwal di server. |
| Database | PostgreSQL | Satu database yang sama untuk lokal dan produksi, sehingga constraint, index, dan query diuji pada engine yang akan dipakai. Laravel mendukung PostgreSQL sebagai database first-party. [Laravel database](https://laravel.com/framework/docs/13.x/database) |
| Container lokal | Docker Compose: `app` + `postgres` | Lingkungan dapat direproduksi tanpa PHP atau PostgreSQL terpasang di host. Docker Compose mendukung urutan mulai berdasarkan health check database. [Docker Compose startup order](https://docs.docker.com/compose/how-tos/startup-order/) |
| Deploy | Image aplikasi + PostgreSQL terpisah | Jalankan aplikasi sebagai container; PostgreSQL memakai volume persisten dan backup off-host. Gunakan tag image PostgreSQL yang dipin, bukan `latest`. [PostgreSQL Docker Official Image](https://hub.docker.com/_/postgres) |

Gunakan migration forward-only untuk seluruh perubahan schema. Laravel migrations dapat mengelola schema lintas database dan menentukan urutan dari timestamp nama berkas. [Laravel migrations](https://laravel.com/framework/docs/13.x/migrations)

### Batas Docker dan data

Compose produksi hanya membutuhkan tiga concern: container aplikasi, PostgreSQL, dan TLS/reverse proxy dari platform atau host. Queue, Redis, worker, dan scheduler tidak dibuat sebelum benar-benar dibutuhkan.

- PostgreSQL memakai named volume; `docker compose down -v`, reset database, dan destructive seed tidak menjadi bagian dari workflow.
- Password database hanya dari environment/secret manager, tidak disimpan pada compose file.
- Migration dijalankan sebagai release step eksplisit, bukan entrypoint/startup container. Backup database harus diuji pemulihannya sebelum go-live.

Docker Official Image mensyaratkan `POSTGRES_PASSWORD`; variabel inisialisasi hanya berpengaruh saat data directory masih kosong. Ini alasan data volume existing tidak boleh dihapus atau ditimpa. [PostgreSQL Docker Official Image](https://hub.docker.com/_/postgres)

## Keputusan motion

MVP **tidak memasang GSAP, Motion, maupun Lenis**. Dua halaman ini adalah alat operasional dengan tabel lebar, form, dan area scroll horizontal; aksesibilitas, fokus keyboard, dan respons input lebih penting daripada scroll yang dianimasikan.

| Library | Keputusan MVP | Kapan dipertimbangkan |
| --- | --- | --- |
| GSAP | Tidak dipakai | Hanya bila ada animasi timeline kompleks yang tidak dapat dibuat dengan CSS/Alpine; GSAP adalah dependency JavaScript tambahan dan plugin harus diregistrasikan eksplisit pada build. [GSAP installation](https://gsap.com/docs/v3/Installation/) |
| Motion | Tidak dipakai | Pilihan pertama bila nanti dibutuhkan satu animasi state kecil—misalnya panel edit yang muncul—dan wajib menghormati `prefers-reduced-motion`. [Motion reduced motion](https://motion.dev/docs/react-use-reduced-motion) |
| Lenis | Tidak dipakai | Tidak cocok untuk grid jadwal pada MVP: Lenis mengambil alih wheel scrolling dan dapat membuat nested scroll perlu penanganan khusus; gunakan native browser scroll. [Motion + Lenis limitations](https://motion.dev/docs/lenis) |

Jika motion benar-benar ditambahkan, gunakan **satu** library saja untuk satu kebutuhan yang terukur, animasikan hanya `transform`/`opacity`, dan sediakan `prefers-reduced-motion` fallback. Tidak ada scroll parallax, smooth-scroll global, atau animasi dekoratif pada halaman admin.

## Data minimum

Tidak perlu tabel "bulan". Satu penugasan per petugas per tanggal sudah cukup dan membuat tampilan bulanan hanyalah query rentang tanggal.

```text
users
  id, name, email, password, is_admin, timestamps

security_officers
  id, name, base_location, is_active, timestamps

schedule_assignments
  id, assignment_date, security_officer_id, location, status, notes?, timestamps
  unique(assignment_date, security_officer_id)
```

Nilai awal `status`: `assigned`, `off`, dan `leave`. `location` menyimpan kode lokasi seperti `PLG`, `HJZ`, `BDG`, atau `SMG`.

Aturan penting: satu petugas hanya boleh memiliki satu assignment pada satu tanggal. Validasi ini dilakukan di request dan dipaksa kembali oleh unique index. Admin dapat menambah/mengubah/nonaktifkan petugas, tetapi data assignment lama tidak ikut terhapus.

## Batas MVP

Termasuk:

- navigasi bulan sebelumnya/berikutnya;
- tabel jadwal responsif untuk empat hingga belasan petugas;
- legenda status dan total `off`/`leave` per petugas;
- login admin dan satu halaman admin berbentuk grid/form;
- audit ringan (`created_at`, `updated_at`; `updated_by` hanya jika riwayat editor memang dibutuhkan).

Tidak termasuk:

- akun untuk setiap security;
- penjadwalan otomatis, aturan rotasi, atau perhitungan payroll;
- notifikasi WhatsApp/email;
- ekspor Excel/PDF, approval, multi-cabang kompleks, dan dashboard.

## Alternatif bila tim sudah TypeScript-first

**Next.js App Router + Supabase** dapat dipilih bila tim sudah mengoperasikan TypeScript dan ingin hosting frontend/database/auth terpisah. Next.js menyediakan Route Handlers untuk endpoint di `app`, sedangkan Supabase menyediakan Postgres, Auth, dan API untuk setiap proyek. [Next.js Route Handlers](https://nextjs.org/docs/app/getting-started/route-handlers) · [Supabase platform](https://supabase.com/docs/guides/platform)

Pilihan ini tetap aman bila semua tabel yang diakses browser memakai Row Level Security (RLS) dan policy yang eksplisit; Supabase menjelaskan RLS tanpa policy akan menolak akses. [Supabase database connections and RLS](https://supabase.com/docs/guides/database/connecting-to-postgres)

Namun, untuk MVP ini alternatif tersebut berarti dua layanan dan policy RLS tambahan. Karena hanya ada satu admin page dan tidak ada kebutuhan API/mobile/realtime, Laravel tetap rekomendasi utama.

## Acceptance criteria implementasi

1. Pengunjung dapat membuka URL publik dan membaca jadwal bulan yang dipilih tanpa login.
2. Admin tak terautentikasi dialihkan ke login; user biasa mendapat 403 dari semua mutasi jadwal.
3. Admin dapat membuat, mengubah, dan menandai libur/cuti untuk penugasan per tanggal tanpa halaman dashboard.
4. Sistem menolak penugasan ganda untuk petugas dan tanggal yang sama.
5. Jadwal tetap nyaman dibaca pada ponsel: kolom tanggal tetap terlihat dan daftar petugas dapat digeser horizontal bila diperlukan.

## Asumsi yang perlu dikonfirmasi sebelum implementasi

- Hanya satu organisasi/cabang dan satu zona waktu Indonesia.
- Admin menginput jadwal; security hanya melihat jadwal publik.
- Lokasi kerja berupa daftar kode tetap, bukan master data dengan aturan kompleks.
- Tidak ada kewajiban SSO, integrasi HR, atau notifikasi pada MVP.
