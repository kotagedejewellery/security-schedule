<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#123d35">
    <title>Masuk Admin - Jadwal Security</title>
    <style>
        :root{--forest:#123d35;--forest-deep:#0b2b25;--paper:#f4f0e7;--sheet:#fffdf8;--ink:#18231f;--muted:#62706a;--line:#d5d8cf;--focus:#e4ae38;--error:#8b372e;--error-bg:#f8e2dd}*{box-sizing:border-box}html{background:var(--paper)}body{min-height:100svh;margin:0;background:var(--paper);color:var(--ink);font:400 16px/1.45 Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;-webkit-font-smoothing:antialiased}::selection{background:#cbe4d8;color:var(--forest-deep)}.access{width:min(100% - 32px,460px);margin:clamp(24px,12vh,120px) auto max(32px,env(safe-area-inset-bottom));border:1px solid var(--line);border-radius:16px 16px 10px 10px;overflow:hidden;background:var(--sheet);box-shadow:0 18px 40px rgba(24,35,31,.10)}.access-header{padding:30px 28px 26px;background:var(--forest);color:#fff}.access-header h1{margin:0;font-size:2rem;line-height:1.03;letter-spacing:-.035em}.access-header p{margin:10px 0 0;color:#d7e3de;font-size:.94rem}.access-body{padding:26px 28px 28px}.field{display:block;margin-top:18px;font-size:.88rem;font-weight:750;color:var(--forest-deep)}.field:first-child{margin-top:0}.field input{display:block;width:100%;min-height:48px;margin-top:7px;padding:11px 12px;border:1px solid #adb9b0;border-radius:8px;background:#fff;color:var(--ink);font:inherit;outline:none;transition:border-color .18s ease,box-shadow .18s ease}.field input:focus{border-color:var(--forest);box-shadow:0 0 0 3px rgba(31,116,98,.18)}.field input:autofill{-webkit-box-shadow:0 0 0 1000px #fff inset}.error{margin:18px 0 0;padding:10px 12px;border-radius:8px;background:var(--error-bg);color:var(--error);font-size:.88rem;font-weight:650}.submit{width:100%;min-height:48px;margin-top:22px;border:1px solid var(--forest);border-radius:8px;background:var(--forest);color:#fff;font:800 .93rem/1 inherit;cursor:pointer;transition:background-color .18s ease,transform .18s ease}.submit:hover{background:var(--forest-deep)}.submit:active{transform:translateY(1px)}.submit:disabled{cursor:wait;opacity:.72}.submit-status{min-height:1.3em;margin:12px 0 0;color:var(--muted);font-size:.86rem}.submit:focus-visible,.back:focus-visible{outline:3px solid var(--focus);outline-offset:3px}.back{display:inline-flex;min-height:44px;align-items:center;margin-top:14px;color:var(--forest);font-size:.88rem;font-weight:800;text-underline-offset:3px}@media (max-width:480px){.access{width:100%;min-height:100svh;margin:0;border:0;border-radius:0;box-shadow:none}.access-header{padding:calc(32px + env(safe-area-inset-top)) 24px 28px}.access-body{padding:26px 24px max(28px,env(safe-area-inset-bottom))}}@media (prefers-reduced-motion:reduce){*,*:before,*:after{transition-duration:.01ms!important}}
        :root{--paper:#edf3f0;--sheet:#fbfdfc}
    </style>
</head>
<body>
    <main class="access">
        <header class="access-header"><h1>Masuk admin</h1><p>Kelola jadwal tanpa dashboard.</p></header>
        <section class="access-body" aria-label="Form masuk admin">
            <form method="post" action="{{ route('admin.login.store') }}" aria-busy="false">
                @csrf
                <label class="field" for="email">Email<input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus @error('email') aria-invalid="true" aria-describedby="login-error" @enderror></label>
                <label class="field" for="password">Kata sandi<input id="password" type="password" name="password" autocomplete="current-password" required @error('password') aria-invalid="true" aria-describedby="login-error" @enderror></label>
                @error('email')<p id="login-error" class="error">{{ $message }}</p>@enderror
                @error('password')<p id="login-error" class="error">{{ $message }}</p>@enderror
                <button class="submit" type="submit">Masuk</button>
                <p id="login-status" class="submit-status" role="status" aria-live="polite"></p>
            </form>
            <a class="back" href="{{ route('schedule.index') }}">Lihat jadwal publik</a>
        </section>
    </main>
</body>
<script>
    document.querySelector('form').addEventListener('submit', function () {
        this.setAttribute('aria-busy', 'true');
        this.querySelector('.submit').disabled = true;
        this.querySelector('.submit').textContent = 'Memeriksa akses…';
        this.querySelector('#login-status').textContent = 'Memeriksa email dan kata sandi.';
    });
</script>
</html>
