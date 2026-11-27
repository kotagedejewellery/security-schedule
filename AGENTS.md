# Instruksi Agen Proyek

1. Baca seluruh `AGENTS.md` yang berlaku, pilih satu skill Matt Pocock yang paling relevan, dan baca penuh `SKILL.md`-nya sebelum bekerja.
2. Gunakan Ponytail level `full` untuk perubahan kode: telusuri dependency/caller/blast radius dan pilih solusi terkecil yang memenuhi requirement.
3. Gunakan Graphify sebelum memahami atau mengubah kode/arsitektur non-trivial, lalu perbarui Graphify setelah satu logical change.
4. Untuk UI/UX, baca `DESIGN.md` bila ada, jalankan `impeccable context` sekali per sesi, lalu gunakan Impeccable; gunakan Inspo untuk arah visual baru dan Hallmark bila relevan.

## Scope dan kualitas

- Pilih solusi paling sederhana; jangan menambah dashboard, API, dependency, refactor, cleanup, atau improvement di luar requirement.
- Pertahankan contract, URL, schema, permission, default, dan behavior di luar scope.
- Ikuti pola/component/utility/dependency existing. Untuk bug, perbaiki root cause dan tambahkan test regresi proporsional.
- Uji business logic, permission, data mutation, migration, shared behavior, dan bug regression sesuai risiko. Jangan mengklaim validasi yang belum dijalankan.

## Data dan security

- Data existing, termasuk database lokal, bukan disposable. Gunakan migration forward-only dan non-destructive.
- Tanpa persetujuan eksplisit, jangan menjalankan reset/recreate database, `migrate:fresh`, `DROP`, truncate, destructive seed/migration, atau menghapus Docker volume.
- Verifikasi environment/target sebelum mutation berisiko. Build, startup, Dockerfile, entrypoint, CI/CD, dan post-deploy tidak boleh mereset database.
- Permission harus ditegakkan di server. Jangan menyimpan secret atau credential yang dapat dipakai di source code atau file terlacak.

## Konteks dan tool

- Baca `PRODUCT.md` dan `docs/PRD.md` untuk product; `docs/TECH-STACK.md` dan `docs/ARCHITECTURE.md` untuk architecture/deployment; serta schema/migration untuk database.
- Jika tool wajib gagal, laporkan command/error dan jangan membuat hasil tiruan.
- Aplikasi memakai Laravel, PostgreSQL, dan Docker Compose. Gunakan `docker compose exec` untuk Artisan; migration adalah langkah eksplisit, bukan startup container.

Prioritas aturan: keselamatan data, security/permission, correctness, scope, behavior existing, architecture existing, regression prevention, testing, performance, lalu cleanup.

```text
Understand → Trace → Change minimally → Protect data → Test → Validate → Stop
```
