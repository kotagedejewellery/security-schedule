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

    public function test_login_page_submits_natively_and_can_reveal_the_password(): void
    {
        $this->get('/admin/login')->assertOk()
            ->assertSee('type="submit"', false)
            ->assertSee('data-password-toggle', false)
            ->assertSee('aria-label="Tampilkan kata sandi"', false)
            ->assertSee('favicon-kgj.png', false)
            ->assertSee('id="login-status"', false)
            ->assertSee('Memeriksa akses', false)
            ->assertDontSee('disabled = true', false)
            ->assertDontSee('loginSubmit.disabled', false);
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
}
