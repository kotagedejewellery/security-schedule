<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#123d35">
    <title>Jadwal Security</title>
    <style>
        :root{--forest:#123d35;--forest-deep:#0b2b25;--paper:#f4f0e7;--sheet:#fffdf8;--ink:#18231f;--muted:#62706a;--line:#d5d8cf;--moss:#1f7462;--moss-soft:#dcefe8;--ochre:#8d5f1e;--ochre-soft:#f6e9cf;--brick:#a04436;--brick-soft:#f7dfda;--focus:#e4ae38}*{box-sizing:border-box}html{background:var(--paper)}body{margin:0;background:var(--paper);color:var(--ink);font:400 16px/1.45 Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;-webkit-font-smoothing:antialiased}::selection{background:#cbe4d8;color:var(--forest-deep)}.page{max-width:1240px;margin:0 auto;padding:16px 16px max(24px,env(safe-area-inset-bottom))}.masthead{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:20px;align-items:end;padding:26px 24px 22px;background:var(--forest);color:#fff;border-radius:16px 16px 4px 4px}.masthead h1{max-width:14ch;margin:0;font-size:clamp(1.8rem,4vw,2.75rem);line-height:1.02;letter-spacing:-.035em}.masthead p{margin:10px 0 0;color:#d7e3de;font-size:.94rem}.month-nav{display:flex;gap:8px;align-items:center}.button{min-height:44px;display:inline-flex;align-items:center;justify-content:center;padding:10px 14px;border:1px solid rgba(255,255,255,.3);border-radius:8px;color:#fff;background:transparent;font:700 .86rem/1 inherit;text-decoration:none;white-space:nowrap;transition:background-color .18s ease,border-color .18s ease}.button:hover{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.55)}.button:active{background:rgba(255,255,255,.2)}.button:focus-visible,.table-frame:focus-visible{outline:3px solid var(--focus);outline-offset:3px}.sheet{overflow:hidden;border:1px solid var(--line);border-top:0;background:var(--sheet);border-radius:0 0 16px 16px;box-shadow:0 14px 32px rgba(24,35,31,.08)}.sheet-heading{display:flex;justify-content:space-between;gap:16px;align-items:baseline;padding:19px 24px 16px;border-bottom:1px solid var(--line)}.sheet-heading h2{margin:0;font-size:1rem;letter-spacing:-.015em}.sheet-heading p{margin:0;color:var(--muted);font-size:.84rem}.table-frame{overflow:auto;overscroll-behavior-inline:contain;scrollbar-color:#9ca8a0 transparent;scrollbar-width:thin}.schedule{width:max-content;min-width:100%;border-collapse:separate;border-spacing:0;font-variant-numeric:tabular-nums}.schedule th,.schedule td{min-width:116px;padding:13px 12px;border-right:1px solid var(--line);border-bottom:1px solid var(--line);text-align:center;white-space:nowrap}.schedule th:last-child,.schedule td:last-child{border-right:0}.schedule thead th{position:sticky;top:0;z-index:2;background:#e6ebe5;color:var(--forest-deep);font-size:.8rem;font-weight:800;letter-spacing:.015em}.schedule th small{display:block;margin-top:3px;color:#63716a;font-size:.69rem;font-weight:700;letter-spacing:.08em}.schedule tbody tr:last-child td{border-bottom:0}.schedule tbody tr:nth-child(even) td:not(.date){background:#fbfaf5}.date{position:sticky;left:0;z-index:1;min-width:132px!important;background:var(--sheet)!important;text-align:left!important;font-weight:800;color:var(--forest-deep);box-shadow:1px 0 0 var(--line)}.schedule thead .date{z-index:3;background:#dce3da!important}.status{display:inline-flex;min-width:48px;min-height:30px;align-items:center;justify-content:center;padding:4px 8px;border-radius:7px;font-size:.78rem;font-weight:800;letter-spacing:.035em}.assigned .status{color:#155847;background:var(--moss-soft)}.off .status{color:#754c14;background:var(--ochre-soft)}.leave .status{color:#80352b;background:var(--brick-soft)}.empty{color:#a0aaa3}.footnote{display:flex;justify-content:space-between;gap:16px;align-items:center;padding:16px 2px 0;color:var(--muted);font-size:.84rem}.legend{display:flex;gap:10px;align-items:center;flex-wrap:wrap}.legend span{display:inline-flex;align-items:center;gap:5px}.legend i{width:8px;height:8px;border-radius:50%;background:var(--moss)}.legend .off-dot{background:var(--ochre)}.legend .leave-dot{background:var(--brick)}.admin-link{color:var(--forest);font-weight:800;text-underline-offset:3px}@media (max-width:700px){.page{padding:0 0 max(16px,env(safe-area-inset-bottom))}.masthead{gap:18px;padding:28px 16px 18px;border-radius:0}.masthead h1{font-size:2.05rem}.month-nav{width:100%;display:grid;grid-template-columns:1fr 1fr}.button{width:100%}.sheet{border-left:0;border-right:0;border-radius:0;box-shadow:none}.sheet-heading{padding:16px;align-items:flex-start;flex-direction:column;gap:4px}.schedule th,.schedule td{min-width:108px;padding:12px 10px}.date{min-width:104px!important}.footnote{padding:16px;align-items:flex-start;flex-direction:column;gap:12px}.admin-link{min-height:44px;display:inline-flex;align-items:center}}@media (prefers-reduced-motion:reduce){*,*:before,*:after{scroll-behavior:auto!important;transition-duration:.01ms!important}}
        .empty-state{padding:48px 24px;text-align:center}.empty-state h3{margin:0;color:var(--forest-deep);font-size:1.05rem}.empty-state p{max-width:34ch;margin:8px auto 0;color:var(--muted);font-size:.9rem}.month-controls{display:flex;gap:8px;align-items:center;flex-wrap:wrap;justify-content:flex-end}.month-jump{display:flex;gap:8px;align-items:center}.month-jump input{min-height:44px;padding:10px 12px;border:1px solid rgba(255,255,255,.38);border-radius:8px;background:transparent;color:#fff;color-scheme:dark;font:700 .86rem/1 inherit}.location-codes{width:100%;font-size:.82rem}.location-codes summary{width:max-content;cursor:pointer;color:var(--forest);font-weight:800;text-underline-offset:3px}.location-codes p{margin:8px 0 0}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}@media (max-width:700px){.month-controls{width:100%;align-items:stretch}.month-jump{width:100%}.month-jump input{min-width:0;flex:1}.month-jump .button{width:auto}}
        :root{--paper:#edf3f0;--sheet:#fbfdfc}.schedule th small{color:#42544a}.empty{color:#52645b}.month-jump input:focus-visible,.location-codes summary:focus-visible{outline:3px solid var(--focus);outline-offset:3px}.location-codes summary{display:flex;align-items:center;min-height:44px}.table-sticky-header{display:none}@media (max-width:700px){.masthead{grid-template-columns:1fr;align-items:stretch}.month-controls{justify-content:stretch}.sheet{overflow:visible}.table-frame{max-height:none;overflow-x:auto;overflow-y:visible}.table-sticky-header{position:sticky;top:0;z-index:6;display:block;overflow:hidden;background:#e6ebe5;border-bottom:1px solid var(--line);box-shadow:0 5px 12px rgba(24,35,31,.10)}.table-sticky-header-track{width:max-content;will-change:transform}.table-sticky-header .schedule{min-width:100%}.table-sticky-header .schedule th{min-width:108px;padding:12px 10px}.table-sticky-header .date{position:relative;left:auto;z-index:1;min-width:104px!important;background:#dce3da!important}.table-frame .schedule thead{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}}
    </style>
</head>
<body>
    <main class="page">
        <header class="masthead">
            <div>
                <h1>Jadwal Security</h1>
                <p>{{ $month->translatedFormat('F Y') }}.@if($lastUpdated) Diperbarui {{ $lastUpdated->timezone(config('app.timezone'))->translatedFormat('j F Y, H:i') }} WIB.@else Jadwal belum diperbarui.@endif</p>
            </div>
            <div class="month-controls">
                <form class="month-jump" method="get"><label class="sr-only" for="month">Pilih bulan</label><input id="month" type="month" name="month" value="{{ $month->format('Y-m') }}"><button class="button" type="submit">Tampilkan</button></form>
                <nav class="month-nav" aria-label="Pilih bulan"><a class="button" href="?month={{ $month->copy()->subMonth()->format('Y-m') }}">Bulan lalu</a><a class="button" href="?month={{ $month->copy()->addMonth()->format('Y-m') }}">Bulan depan</a></nav>
            </div>
        </header>
        <section class="sheet" aria-labelledby="schedule-title">
            <div class="sheet-heading"><h2 id="schedule-title">Penugasan harian</h2><p>Geser tabel untuk melihat semua petugas</p></div>
            <div class="table-region" data-sticky-table>
                @if($officers->isEmpty())
                    <div class="empty-state"><h3>Belum ada petugas aktif</h3><p>Jadwal akan tampil di sini setelah data petugas tersedia.</p></div>
                @elseif($assignments->isEmpty())
                    <div class="empty-state"><h3>Belum ada penugasan untuk {{ $month->translatedFormat('F Y') }}</h3><p>Hubungi admin atau koordinator untuk memperbarui jadwal bulan ini.</p></div>
                @else
                    <div class="table-sticky-header" aria-hidden="true"><div class="table-sticky-header-track"><table class="schedule"><thead><tr><th class="date" data-sticky-date>Tanggal</th>@foreach($officers as $officer)<th>{{ $officer->name }}<small>{{ $officer->base_location }}</small></th>@endforeach</tr></thead></table></div></div>
                    <div class="table-frame" tabindex="0" aria-label="Tabel jadwal bulanan, geser secara horizontal untuk melihat petugas lainnya">
                        <table class="schedule">
                            <thead><tr><th class="date" scope="col">Tanggal</th>@foreach($officers as $officer)<th scope="col">{{ $officer->name }}<small>{{ $officer->base_location }}</small></th>@endforeach</tr></thead>
                            <tbody>@for($day=$month->copy();$day->month===$month->month;$day->addDay())<tr><th class="date" scope="row">{{ $day->translatedFormat('D, j') }}</th>@foreach($officers as $officer)@php($item=$assignments->get($day->format('Y-m-d').'-'.$officer->id))<td class="{{ $item?->status ?? '' }}">@if($item)<span class="status">{{ $item->status==='off'?'Libur':($item->status==='leave'?'Cuti':$item->location) }}</span>@else<span class="empty">&mdash;</span>@endif</td>@endforeach</tr>@endfor</tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>
        <footer class="footnote"><div class="legend" aria-label="Keterangan status"><span><i></i> Bertugas</span><span><i class="off-dot"></i> Libur</span><span><i class="leave-dot"></i> Cuti</span></div><details class="location-codes"><summary>Kode lokasi</summary><p>PLG: Palagan · HJZ: Hijaz · BDG: Bandung · SMG: Semarang</p></details></footer>
    </main>
<script>
document.querySelectorAll('[data-sticky-table]').forEach((region) => {
    const frame = region.querySelector('.table-frame');
    const track = region.querySelector('.table-sticky-header-track');
    const date = region.querySelector('[data-sticky-date]');
    if (!frame || !track || !date) return;
    const syncHeader = () => {
        track.style.transform = `translateX(${-frame.scrollLeft}px)`;
        date.style.transform = `translateX(${frame.scrollLeft}px)`;
    };
    frame.addEventListener('scroll', syncHeader, { passive: true });
    syncHeader();
});
</script>
</body>
</html>
