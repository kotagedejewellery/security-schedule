<?php

namespace Tests\Feature;

use App\Models\ScheduleAssignment;
use App\Models\SecurityOfficer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_read_the_schedule_but_non_admin_cannot_open_admin(): void
    {
        $viewer = User::factory()->create(['is_admin' => false]);

        $this->get('/')->assertOk()->assertSee('favicon-kgj.png')->assertDontSee('Masuk sebagai admin');
        $this->actingAs($viewer)->get('/')->assertOk();
        $this->actingAs($viewer)->get('/?month=invalid')->assertOk();
        $this->actingAs($viewer)->get('/admin/jadwal')->assertForbidden();
    }

    public function test_admin_can_clear_an_existing_assignment(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $officer = SecurityOfficer::create(['name' => 'Mustangin', 'base_location' => 'PLG']);
        ScheduleAssignment::create(['assignment_date' => '2026-11-01', 'security_officer_id' => $officer->id, 'status' => 'assigned', 'location' => 'PLG']);

        $this->actingAs($admin)->put('/admin/jadwal', [
            'month' => '2026-11',
            'assignments' => ['2026-11-01' => [$officer->id => '']],
        ])->assertRedirect('/admin/jadwal?month=2026-11');

        $this->assertDatabaseMissing('schedule_assignments', ['assignment_date' => '2026-11-01', 'security_officer_id' => $officer->id]);
    }

    public function test_admin_can_save_an_assignment(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $officer = SecurityOfficer::create(['name' => 'Mustangin', 'base_location' => 'PLG']);

        $this->actingAs($admin)->put('/admin/jadwal', [
            'month' => '2026-11',
            'assignments' => ['2026-11-01' => [$officer->id => 'HJZ']],
        ])->assertRedirect('/admin/jadwal?month=2026-11');

        $this->assertSame('HJZ', ScheduleAssignment::whereDate('assignment_date', '2026-11-01')->where('security_officer_id', $officer->id)->value('location'));
        $this->actingAs($admin)->get('/admin/jadwal?month=2026-11')->assertOk()->assertSee('Mustangin');
    }

    public function test_admin_can_log_in(): void
    {
        $admin = User::factory()->create(['email' => 'admin@example.test', 'password' => 'secret-password', 'is_admin' => true]);

        $this->post('/admin/login', ['email' => $admin->email, 'password' => 'secret-password'])->assertRedirect('/admin/jadwal');

        $this->assertAuthenticatedAs($admin);
    }

    public function test_https_proxy_generates_secure_login_asset_and_redirect_urls(): void
    {
        $admin = User::factory()->create(['email' => 'admin@example.test', 'password' => 'secret-password', 'is_admin' => true]);
        $headers = ['HTTP_HOST' => 'schedule.example.test', 'HTTP_X_FORWARDED_PROTO' => 'https'];

        $this->withServerVariables($headers)->get('http://schedule.example.test/login')
            ->assertOk()
            ->assertSee('href="https://schedule.example.test/favicon-kgj.png"', false)
            ->assertSee('action="https://schedule.example.test/admin/login"', false);

        $this->withServerVariables($headers)->post('http://schedule.example.test/admin/login', [
            'email' => $admin->email, 'password' => 'secret-password',
        ])->assertRedirect('https://schedule.example.test/admin/jadwal');
    }

    public function test_admin_logout_redirects_to_login_and_ends_the_session(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
        $this->get('/admin/jadwal')->assertRedirect('/login');
    }

    public function test_login_page_submits_natively_and_can_reveal_the_password(): void
    {
        $this->get('/admin/login')->assertOk()
            ->assertSee('type="submit"', false)
            ->assertSee('data-password-toggle', false)
            ->assertSee('aria-label="Tampilkan kata sandi"', false)
            ->assertSee('favicon-kgj.png', false)
            ->assertSee('id="login-status"', false)
            ->assertSee('Memeriksa akses', false)
            ->assertSee("loginSubmit.addEventListener('click'", false)
            ->assertDontSee('disabled = true', false)
            ->assertDontSee('loginSubmit.disabled', false)
            ->assertDontSee("loginForm.addEventListener('submit'", false)
            ->assertDontSee('preventDefault()', false);
    }

    public function test_login_is_rate_limited_after_five_failures(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post('/admin/login', ['email' => 'admin@example.test', 'password' => 'wrong-password'])->assertSessionHasErrors('email');
        }

        $this->post('/admin/login', ['email' => 'admin@example.test', 'password' => 'wrong-password'])
            ->assertSessionHasErrors(['email' => 'Terlalu banyak percobaan. Coba lagi satu menit.']);
    }

    public function test_empty_admin_schedule_does_not_offer_a_save_action(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->get('/admin/jadwal')->assertOk()
            ->assertDontSee('Simpan perubahan')
            ->assertSee('Hubungi koordinator untuk menambahkan petugas aktif.');
    }

    public function test_admin_editor_makes_clearing_and_horizontal_scroll_explicit(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $officer = SecurityOfficer::create(['name' => 'Mustangin', 'base_location' => 'PLG']);
        ScheduleAssignment::create(['assignment_date' => '2026-11-01', 'security_officer_id' => $officer->id, 'status' => 'assigned', 'location' => 'PLG']);

        $this->actingAs($admin)->get('/admin/jadwal?month=2026-11')->assertOk()
            ->assertSee('Hapus penugasan')
            ->assertSee('Geser tabel untuk melihat petugas lain.')
            ->assertSee('Perubahan belum disimpan.')
            ->assertDontSee('Lihat publik');
    }

    public function test_admin_page_uses_an_application_dialog_to_confirm_logout(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->get('/admin/jadwal')->assertOk()
            ->assertSee('favicon-kgj.png')
            ->assertSee('class="admin-title-row"', false)
            ->assertSee('id="confirm-dialog"', false)
            ->assertSee('Keluar dari editor?', false)
            ->assertSee('dialog.showModal()', false)
            ->assertDontSee('event.currentTarget.submit()', false)
            ->assertDontSee('window.confirm', false);
    }

    public function test_public_schedule_explains_when_officers_have_no_assignments(): void
    {
        SecurityOfficer::create(['name' => 'Mustangin', 'base_location' => 'PLG']);

        $this->get('/?month=2026-11')->assertOk()->assertSee('Belum ada penugasan untuk November 2026');
    }

    public function test_public_schedule_shows_when_an_assignment_was_last_updated(): void
    {
        $officer = SecurityOfficer::create(['name' => 'Mustangin', 'base_location' => 'PLG']);
        ScheduleAssignment::create(['assignment_date' => '2026-11-01', 'security_officer_id' => $officer->id, 'status' => 'assigned', 'location' => 'PLG']);

        $this->get('/?month=2026-11')->assertOk()->assertSee('Diperbarui');
    }

    public function test_monthly_summary_counts_saved_off_and_leave_per_officer_on_both_pages(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $first = SecurityOfficer::create(['name' => 'Mustangin', 'base_location' => 'PLG']);
        $second = SecurityOfficer::create(['name' => 'Fikri', 'base_location' => 'HJZ']);
        SecurityOfficer::create(['name' => 'Bayu', 'base_location' => 'BDG']);

        foreach ([['2026-11-01', 'off'], ['2026-11-02', 'off'], ['2026-11-03', 'leave'], ['2026-12-01', 'off']] as [$date, $status]) {
            ScheduleAssignment::create(['assignment_date' => $date, 'security_officer_id' => $first->id, 'status' => $status]);
        }
        ScheduleAssignment::create(['assignment_date' => '2026-11-01', 'security_officer_id' => $second->id, 'status' => 'assigned', 'location' => 'HJZ']);

        foreach (['/?month=2026-11', '/admin/jadwal?month=2026-11'] as $url) {
            $this->actingAs($admin)->get($url)->assertOk()
                ->assertSee('Rekap November 2026')
                ->assertSee('Rekap hanya menghitung jadwal yang sudah diisi.')
                ->assertSee('<tr><th scope="row">Mustangin</th><td>2 hari</td><td>1 hari</td></tr>', false)
                ->assertSee('<tr><th scope="row">Fikri</th><td>0 hari</td><td>0 hari</td></tr>', false)
                ->assertSee('<tr><th scope="row">Bayu</th><td colspan="2">Belum ada jadwal</td></tr>', false);
        }

        $this->actingAs($admin)->get('/admin/jadwal?month=2026-11')->assertSee('Simpan perubahan untuk memperbarui rekap.');
        $this->get('/?month=2027-01')->assertSee('Belum ada jadwal untuk direkap.');
    }

    public function test_monthly_summary_updates_after_saving_changing_and_clearing_assignments(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $officer = SecurityOfficer::create(['name' => 'Mustangin', 'base_location' => 'PLG']);
        $url = '/admin/jadwal?month=2026-11';

        foreach (['OFF' => ['1 hari', '0 hari'], 'LEAVE' => ['0 hari', '1 hari'], '' => null] as $value => $expected) {
            $this->actingAs($admin)->put('/admin/jadwal', [
                'month' => '2026-11',
                'assignments' => ['2026-11-01' => [$officer->id => $value]],
            ])->assertRedirect($url);

            foreach (['/?month=2026-11', $url] as $page) {
                $response = $this->actingAs($admin)->get($page)->assertOk();
                if ($expected) {
                    $response->assertSee('<tr><th scope="row">Mustangin</th><td>'.$expected[0].'</td><td>'.$expected[1].'</td></tr>', false);
                } else {
                    $response->assertSee('Belum ada jadwal untuk direkap.');
                }
            }
        }
    }
}
