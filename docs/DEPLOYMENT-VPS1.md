# Deployment production di VPS 1

Konfigurasi ini memakai Traefik yang sudah ada. Jangan mengubah Traefik global, container, router, database, volume, atau project lain.

## Ringkasan

| Item | Nilai |
| --- | --- |
| Stack | Laravel 13 + Blade + PHP 8.4 Apache |
| Internal port | `80` pada container `app` |
| Database | PostgreSQL 17.7 pada volume `security-schedule_database-data` |
| Redis/cache | Tidak diperlukan; cache dan session memakai PostgreSQL |
| Worker/scheduler | Tidak diperlukan |
| Domain | `APP_DOMAIN` (wajib ditentukan owner) |
| Environment | `/opt/apps/security-schedule/.env.production`, tidak dilacak Git |
| Docker services | `app`, `database` |
| Network | `app` di `proxy` dan `internal`; database hanya di `internal` |
| Auto deploy | Push `main` → validasi Compose → SSH → recreate `app` saja → health check |

Tidak ada host port yang dibuka oleh project ini. Hanya Traefik yang menerima trafik pada port 80/443.

## Bootstrap satu kali

1. Pastikan DNS `APP_DOMAIN` sudah mengarah ke VPS 1, dan network Docker `proxy` dari Traefik tersedia.
2. Di VPS, clone repository ke `/opt/apps/security-schedule` sebagai user `Kotagede-Jewellery`.
3. Salin `.env.production.example` menjadi `.env.production`. Isi domain, `APP_KEY` unik, password database unik, dan kredensial admin awal. Untuk membuat `APP_KEY` tanpa memasang PHP di host, jalankan `docker run --rm php:8.4-cli php -r "echo 'base64:'.base64_encode(random_bytes(32)).PHP_EOL;"`, lalu simpan hasilnya hanya di file tersebut. File ini tidak boleh masuk Git atau log.
4. Validasi konfigurasi:

   ```bash
   cd /opt/apps/security-schedule
   docker compose --env-file .env.production -f compose.production.yml config
   ```

5. Buat database dan jalankan migration secara eksplisit. Untuk database baru, seed awal juga dijalankan satu kali:

   ```bash
   docker compose --env-file .env.production -f compose.production.yml up -d database
   docker compose --env-file .env.production -f compose.production.yml run --rm --no-deps app php artisan migrate --force
   docker compose --env-file .env.production -f compose.production.yml run --rm --no-deps app php artisan db:seed --class=DatabaseSeeder
   docker compose --env-file .env.production -f compose.production.yml up -d --build app
   ```

6. Verifikasi hanya project ini, lalu akses `https://<APP_DOMAIN>`:

   ```bash
   docker compose --env-file .env.production -f compose.production.yml ps
   docker compose --env-file .env.production -f compose.production.yml logs --tail=100
   curl -I https://<APP_DOMAIN>
   ```

Uji halaman publik, login admin, logout, penyimpanan jadwal, dan tampilan mobile. Setelah itu jalankan `~/vps-audit.sh > ~/vps-audit-latest.txt` dan pastikan project existing tetap berjalan.

## Migration rilis berikutnya

Workflow GitHub **tidak** menjalankan migration atau seed. Bila rilis membawa migration, review terlebih dahulu, buat backup database, lalu jalankan manual dengan perintah berikut setelah approval:

```bash
docker compose --env-file .env.production -f compose.production.yml exec -T app php artisan migrate --force
```

Jangan memakai `migrate:fresh`, `db:wipe`, `docker compose down -v`, `docker volume rm`, atau `docker system prune`.

## GitHub Actions

Simpan secrets repository berikut tanpa menaruhnya di source code:

- `VPS_HOST`
- `VPS_USER` (`Kotagede-Jewellery`)
- `VPS_SSH_KEY`
- `VPS_SSH_KNOWN_HOSTS`

Workflow `.github/workflows/deploy.yml` hanya menjalankan `git pull`, validasi Compose, build/recreate service `app`, dan health check project ini. Database tidak direcreate dan project lain tidak disentuh.
