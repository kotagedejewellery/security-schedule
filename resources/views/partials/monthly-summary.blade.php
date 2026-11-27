<style>
    .monthly-summary{margin-top:16px;padding:20px 24px;background:var(--sheet);border:1px solid var(--line);border-radius:12px;color:var(--ink)}
    .monthly-summary h2{margin:0;color:var(--forest-deep);font-size:1rem}.monthly-summary p{margin:6px 0 0;color:var(--muted);font-size:.88rem}
    .summary-table{width:100%;margin-top:14px;border-collapse:collapse;table-layout:fixed;font-size:.9rem;font-variant-numeric:tabular-nums}.summary-table th,.summary-table td{padding:10px 4px;border-bottom:1px solid var(--line)}.summary-table th:first-child{text-align:left;overflow-wrap:anywhere}.summary-table th:not(:first-child),.summary-table td{text-align:center;width:24%}.summary-table thead th{color:var(--muted);font-size:.8rem}.summary-table tbody tr:last-child th,.summary-table tbody tr:last-child td{border-bottom:0}
    @media(max-width:700px){.monthly-summary{margin:12px 0 0;padding:18px 16px;border-left:0;border-right:0;border-radius:0}}
</style>
<section class="monthly-summary" aria-labelledby="monthly-summary-title">
    <h2 id="monthly-summary-title">Rekap {{ $month->translatedFormat('F Y') }}</h2>
    @if($assignments->isEmpty())
        <p>Belum ada jadwal untuk direkap.</p>
    @else
        <p>Rekap hanya menghitung jadwal yang sudah diisi.{{ !empty($adminSummary) ? ' Simpan perubahan untuk memperbarui rekap.' : '' }}</p>
        <table class="summary-table">
            <thead><tr><th scope="col">Petugas</th><th scope="col">Libur</th><th scope="col">Cuti</th></tr></thead>
            <tbody>
                @foreach($officers as $officer)
                    @php($officerAssignments = $assignments->where('security_officer_id', $officer->id))
                    @if($officerAssignments->isEmpty())
                        <tr><th scope="row">{{ $officer->name }}</th><td colspan="2">Belum ada jadwal</td></tr>
                    @else
                        <tr><th scope="row">{{ $officer->name }}</th><td>{{ $officerAssignments->where('status', 'off')->count() }} hari</td><td>{{ $officerAssignments->where('status', 'leave')->count() }} hari</td></tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</section>
