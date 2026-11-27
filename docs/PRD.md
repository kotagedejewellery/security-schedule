# Product Requirements: Jadwal Security

## Tujuan

Menggantikan spreadsheet jadwal security bulanan dengan satu halaman baca dan satu halaman admin yang sederhana.

## Pengguna dan halaman

| Pengguna | Halaman | Kemampuan |
| --- | --- | --- |
| Security | `/` | Melihat jadwal seluruh petugas per bulan. |
| Admin | `/admin/login`, `/admin/jadwal` | Masuk, memilih bulan, menyimpan lokasi, libur, cuti, atau mengosongkan penugasan. |

## Aturan bisnis

- Satu petugas mempunyai maksimal satu penugasan untuk satu tanggal.
- Nilai penugasan: `PLG`, `HJZ`, `BDG`, `SMG`, `Libur`, atau `Cuti`.
- Jadwal yang dikosongkan admin menghapus penugasan pada tanggal dan petugas tersebut.
- Semua tanggal memakai zona waktu `Asia/Jakarta`.
- Halaman publik read-only; mutasi selalu memerlukan admin di server.

## Batas MVP

Tidak ada dashboard, rotasi otomatis, payroll, notifikasi, ekspor, approval, atau manajemen petugas melalui UI.
