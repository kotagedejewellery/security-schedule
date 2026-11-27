<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#123d35">
    <title>Kelola Jadwal - Security</title>
    <style>
        :root{--forest:#123d35;--forest-deep:#0b2b25;--paper:#f4f0e7;--sheet:#fffdf8;--ink:#18231f;--muted:#62706a;--line:#d5d8cf;--moss:#1f7462;--focus:#e4ae38;--success:#155847;--success-bg:#dcefe8}*{box-sizing:border-box}html{background:var(--paper)}body{margin:0;background:var(--paper);color:var(--ink);font:400 16px/1.45 Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;-webkit-font-smoothing:antialiased}::selection{background:#cbe4d8;color:var(--forest-deep)}.page{max-width:1320px;margin:0 auto;padding:16px 16px max(32px,env(safe-area-inset-bottom))}.admin-head{display:flex;justify-content:space-between;gap:24px;align-items:start;padding:26px 24px;background:var(--forest);color:#fff;border-radius:16px 16px 4px 4px}.admin-head h1{margin:0;font-size:clamp(1.8rem,4vw,2.65rem);line-height:1.04;letter-spacing:-.035em}.admin-head p{margin:9px 0 0;color:#d7e3de;font-size:.92rem}.success{margin-top:12px!important;padding:8px 10px;border-radius:7px;background:var(--success-bg);color:var(--success)!important;font-weight:800}.header-actions{display:flex;gap:8px;align-items:center;flex-wrap:wrap;justify-content:flex-end}.month-picker{display:flex;gap:8px;align-items:center}.month-picker input,.button,button,select{min-height:44px;padding:10px 12px;border:1px solid var(--line);border-radius:8px;background:#fff;color:var(--ink);font:750 .88rem/1 inherit}.month-picker input{border-color:rgba(255,255,255,.38);color:#fff;background:transparent;color-scheme:dark}.button,button{display:inline-flex;align-items:center;justify-content:center;cursor:pointer;text-decoration:none}.button{color:#fff;background:transparent;border-color:rgba(255,255,255,.38)}.button:hover{background:rgba(255,255,255,.12)}.plain{color:#fff;background:transparent;border-color:rgba(255,255,255,.38)}.plain:hover{background:rgba(255,255,255,.12)}.primary{color:#fff;background:var(--forest);border-color:var(--forest)}.primary:hover{background:var(--forest-deep)}.button:focus-visible,button:focus-visible,input:focus-visible,select:focus-visible,.table-frame:focus-visible{outline:3px solid var(--focus);outline-offset:3px}.savebar{position:sticky;top:8px;z-index:5;display:flex;justify-content:space-between;gap:12px;align-items:center;margin:16px 0 12px;padding:10px 12px;background:rgba(244,240,231,.96);border:1px solid #d1d2c8;border-radius:10px;box-shadow:0 8px 18px rgba(24,35,31,.10);backdrop-filter:blur(10px)}.savebar p{margin:0;color:var(--muted);font-size:.84rem}.save-actions{display:flex;gap:8px;align-items:center;flex-shrink:0}.public-link{min-height:44px;display:inline-flex;align-items:center;padding:10px 8px;color:var(--forest);font-size:.88rem;font-weight:800;text-decoration:none;text-underline-offset:3px}.sheet{overflow:hidden;border:1px solid var(--line);background:var(--sheet);border-radius:12px;box-shadow:0 14px 32px rgba(24,35,31,.08)}.table-frame{overflow:auto;overscroll-behavior-inline:contain;scrollbar-color:#9ca8a0 transparent;scrollbar-width:thin}.schedule{width:max-content;min-width:100%;border-collapse:separate;border-spacing:0;font-variant-numeric:tabular-nums}.schedule th,.schedule td{min-width:132px;padding:10px;border-right:1px solid var(--line);border-bottom:1px solid var(--line);text-align:center;white-space:nowrap}.schedule th:last-child,.schedule td:last-child{border-right:0}.schedule thead th{position:sticky;top:0;z-index:2;background:#e6ebe5;color:var(--forest-deep);font-size:.8rem;font-weight:800;letter-spacing:.015em}.schedule th small{display:block;margin-top:3px;color:#63716a;font-size:.69rem;font-weight:700;letter-spacing:.08em}.schedule tbody tr:last-child td{border-bottom:0}.schedule tbody tr:nth-child(even) td:not(.date){background:#fbfaf5}.date{position:sticky;left:0;z-index:1;min-width:132px!important;background:var(--sheet)!important;text-align:left!important;font-weight:800;color:var(--forest-deep);box-shadow:1px 0 0 var(--line)}.schedule thead .date{z-index:3;background:#dce3da!important}.schedule select{width:100%;min-width:106px;background:#fff}.schedule select:focus{border-color:var(--forest)}@media (max-width:780px){.page{padding:0 0 max(20px,env(safe-area-inset-bottom))}.admin-head{padding:calc(28px + env(safe-area-inset-top)) 16px 20px;border-radius:0;flex-direction:column}.header-actions{width:100%;justify-content:stretch}.month-picker{flex:1}.month-picker input{min-width:0;flex:1}.month-picker button{flex:1}.header-actions>.button,.header-actions>.plain{flex:1}.savebar{top:8px;margin:10px 12px 12px;align-items:flex-start;flex-direction:column}.save-actions{width:100%;justify-content:space-between}.primary{flex:1}.sheet{border-left:0;border-right:0;border-radius:0;box-shadow:none}.schedule th,.schedule td{min-width:122px}.date{min-width:104px!important}.public-link{padding-left:0}}@media (prefers-reduced-motion:reduce){*,*:before,*:after{scroll-behavior:auto!important;transition-duration:.01ms!important}}
        .empty-state{padding:48px 24px;text-align:center}.empty-state h2{margin:0;color:var(--forest-deep);font-size:1.05rem}.empty-state p{max-width:34ch;margin:8px auto 0;color:var(--muted);font-size:.9rem}
        :root{--paper:#edf3f0;--sheet:#fbfdfc}.savebar{background:rgba(237,243,240,.96)}.admin-title-row{display:flex;justify-content:space-between;gap:12px;align-items:flex-start}.admin-title-row .logout-form{flex-shrink:0}.schedule th small{color:#42544a}.table-hint{margin:0;padding:12px 12px 0;color:var(--muted);font-size:.84rem}.save-copy{min-width:0}.changes-status{margin-top:4px!important;color:var(--forest)!important;font-weight:800}.table-sticky-header{display:none}.confirm-dialog{width:min(calc(100% - 32px),400px);margin:auto;padding:0;border:1px solid var(--line);border-radius:14px;background:var(--sheet);color:var(--ink);box-shadow:0 24px 56px rgba(11,43,37,.28)}.confirm-dialog::backdrop{background:rgba(11,43,37,.52);backdrop-filter:blur(2px)}.confirm-dialog form{padding:22px}.confirm-dialog h2{margin:0;color:var(--forest-deep);font-size:1.25rem;letter-spacing:-.025em}.confirm-dialog p{margin:8px 0 0;color:var(--muted);font-size:.92rem}.confirm-actions{display:flex;justify-content:flex-end;gap:8px;margin-top:20px}.confirm-actions .secondary{background:transparent;color:var(--forest);border-color:#b8c5bd}.confirm-actions .secondary:hover{background:#edf3f0}@media (max-width:780px){.admin-title-row{align-items:center}.header-actions{display:grid;grid-template-columns:1fr}.month-picker{width:100%}.table-hint{padding:12px 16px 0}.sheet{overflow:visible}.table-frame{max-height:none;overflow-x:auto;overflow-y:visible}.table-sticky-header{position:sticky;top:0;z-index:6;display:block;overflow:hidden;background:#e6ebe5;border-bottom:1px solid var(--line);box-shadow:0 5px 12px rgba(24,35,31,.10)}.table-sticky-header-track{width:max-content;will-change:transform}.table-sticky-header .schedule{min-width:100%}.table-sticky-header .schedule th{min-width:122px;padding:10px}.table-sticky-header .date{position:relative;left:auto;z-index:1;min-width:104px!important;background:#dce3da!important}.table-frame .schedule thead{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}.confirm-dialog{width:min(calc(100% - 24px),400px);margin:auto 12px 12px}.confirm-dialog form{padding:20px}.confirm-actions{flex-direction:column-reverse}.confirm-actions button{width:100%}}
    </style>
</head>
<body>
    <main class="page">
        <header class="admin-head">
            <div>
                <div class="admin-title-row"><h1>Kelola jadwal</h1><form id="logout-form" class="logout-form" method="post" action="{{ route('admin.logout') }}">@csrf<button class="plain" type="submit">Keluar</button></form></div>
                <p>{{ $month->translatedFormat('F Y') }}. Pilih penugasan setiap petugas, lalu simpan.</p>
                @if(session('saved'))<p class="success" role="status">{{ session('saved') }}</p>@endif
            </div>
            <div class="header-actions">
                <form id="month-picker" class="month-picker" method="get"><input type="month" name="month" value="{{ $month->format('Y-m') }}" aria-label="Pilih bulan"><button class="plain" type="submit">Tampilkan</button></form>
            </div>
        </header>
        <form id="schedule-form" method="post" action="{{ route('admin.schedule.update') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="month" value="{{ $month->format('Y-m') }}">
            @if($officers->isNotEmpty())
                <div class="savebar"><div class="save-copy"><p>Untuk menghapus jadwal tersimpan, pilih “Hapus penugasan”.</p><p id="changes-status" class="changes-status" role="status" aria-live="polite">Semua perubahan tersimpan.</p></div><div class="save-actions"><a class="public-link" data-discard href="{{ route('schedule.index',['month'=>$month->format('Y-m')]) }}">Pratinjau publik</a><button class="primary" type="submit">Simpan perubahan</button></div></div>
            @endif
            <section class="sheet" aria-label="Editor jadwal bulanan">
                <p class="table-hint">Geser tabel untuk melihat petugas lain.</p>
                <div class="table-region" data-sticky-table>
                    @if($officers->isEmpty())
                        <div class="empty-state"><h2>Belum ada petugas aktif</h2><p>Hubungi koordinator untuk menambahkan petugas aktif.</p></div>
                    @else
                        <div class="table-sticky-header" aria-hidden="true"><div class="table-sticky-header-track"><table class="schedule"><thead><tr><th class="date" data-sticky-date>Tanggal</th>@foreach($officers as $o)<th>{{ $o->name }}<small>{{ $o->base_location }}</small></th>@endforeach</tr></thead></table></div></div>
                        <div class="table-frame" tabindex="0" aria-label="Tabel editor jadwal, geser secara horizontal untuk melihat petugas lainnya">
                            <table class="schedule">
                                <thead><tr><th class="date" scope="col">Tanggal</th>@foreach($officers as $o)<th scope="col">{{ $o->name }}<small>{{ $o->base_location }}</small></th>@endforeach</tr></thead>
                                <tbody>
                                    @for($day=$month->copy();$day->month===$month->month;$day->addDay())
                                        <tr>
                                            <th class="date" scope="row">{{ $day->translatedFormat('D, j') }}</th>
                                            @foreach($officers as $o)
                                                @php
                                                    $item = $assignments->get($day->format('Y-m-d').'-'.$o->id);
                                                    $current = $item?->status === 'off' ? 'OFF' : ($item?->status === 'leave' ? 'LEAVE' : $item?->location);
                                                @endphp
                                                <td><select name="assignments[{{ $day->format('Y-m-d') }}][{{ $o->id }}]" aria-label="{{ $o->name }} pada {{ $day->translatedFormat('j F') }}"><option value="">{{ $current ? 'Hapus penugasan' : 'Belum diisi' }}</option>@foreach($values as $value)<option value="{{ $value }}" @selected($current===$value)>{{ $value==='OFF'?'Libur':($value==='LEAVE'?'Cuti':$value) }}</option>@endforeach</select></td>
                                            @endforeach
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </section>
        </form>
    </main>
<dialog id="confirm-dialog" class="confirm-dialog" aria-labelledby="confirm-title" aria-describedby="confirm-message">
    <form method="dialog"><h2 id="confirm-title">Keluar dari editor?</h2><p id="confirm-message">Sesi admin akan diakhiri.</p><div class="confirm-actions"><button class="secondary" value="cancel">Batal</button><button id="confirm-action" class="primary" value="confirm">Keluar</button></div></form>
</dialog>
<script>
    const editor = document.querySelector('#schedule-form');
    if (editor) {
        let dirty = false;
        const status = document.querySelector('#changes-status');
        const dialog = document.querySelector('#confirm-dialog');
        const dialogTitle = document.querySelector('#confirm-title');
        const dialogMessage = document.querySelector('#confirm-message');
        const dialogAction = document.querySelector('#confirm-action');
        let pendingAction;
        let dialogInvoker;
        const requestConfirmation = (title, message, label, action) => {
            pendingAction = action;
            dialogInvoker = document.activeElement;
            dialogTitle.textContent = title;
            dialogMessage.textContent = message;
            dialogAction.textContent = label;
            dialog.showModal();
            dialogAction.focus();
        };
        const discardChanges = (action) => {
            if (!dirty) return action();
            requestConfirmation('Batalkan perubahan?', 'Perubahan yang belum disimpan akan hilang.', 'Lanjutkan', action);
        };

        dialog.addEventListener('close', () => {
            const action = dialog.returnValue === 'confirm' ? pendingAction : null;
            const invoker = dialogInvoker;
            pendingAction = undefined;
            dialogInvoker = undefined;
            if (action) return action();
            invoker?.focus();
        });

        editor.querySelectorAll('select').forEach((select) => select.addEventListener('change', () => {
            dirty = true;
            status.textContent = 'Perubahan belum disimpan.';
        }));
        editor.addEventListener('submit', () => { dirty = false; });
        const monthPicker = document.querySelector('#month-picker');
        monthPicker?.addEventListener('submit', (event) => { event.preventDefault(); discardChanges(() => monthPicker.submit()); });
        const logoutForm = document.querySelector('#logout-form');
        logoutForm?.addEventListener('submit', (event) => { event.preventDefault(); requestConfirmation('Keluar dari editor?', dirty ? 'Perubahan yang belum disimpan akan hilang.' : 'Sesi admin akan diakhiri.', 'Keluar', () => { dirty = false; logoutForm.submit(); }); });
        document.querySelectorAll('[data-discard]').forEach((link) => link.addEventListener('click', (event) => { event.preventDefault(); discardChanges(() => window.location.assign(link.href)); }));
        window.addEventListener('beforeunload', (event) => { if (dirty) { event.preventDefault(); event.returnValue = ''; } });
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
        // shortcut: changing a cell back still counts as dirty; track initial values only if repeated prompts become a problem.
    }
</script>
</body>
</html>
