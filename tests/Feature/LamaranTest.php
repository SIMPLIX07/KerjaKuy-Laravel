<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\Pelamar;
use App\Models\Perusahaan;
use App\Models\Lowongan;
use App\Models\Cv;
use App\Models\Lamaran;
use App\Models\Wawancara;

class LamaranTest extends TestCase
{
    use RefreshDatabase;

    private $pelamar;
    private $perusahaan;
    private $lowongan;
    private $cv;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Create a Pelamar
        $this->pelamar = Pelamar::create([
            'nama_lengkap' => 'Budi Santoso',
            'username' => 'budis',
            'email' => 'budi@mail.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Create a Perusahaan
        $this->perusahaan = Perusahaan::create([
            'nama_perusahaan' => 'PT Teknologi Indonesia',
            'email' => 'tech@indonesia.com',
            'password' => bcrypt('password123'),
            'alamat' => 'Bandung',
            'telepon' => '0221234567',
            'npwp' => '0123456789',
            'status_verifikasi' => 'verified',
        ]);

        // 3. Create a Lowongan
        $this->lowongan = Lowongan::create([
            'perusahaan_id' => $this->perusahaan->id,
            'kategori_pekerjaan' => 'Teknologi',
            'posisi_pekerjaan' => 'Web Developer',
            'jenis_pekerjaan' => 'Full-time',
            'gaji' => '8000000',
            'deskripsi_singkat' => 'Lowongan Web Developer',
            'deskripsi_pekerjaan' => 'Mengembangkan web app Laravel',
            'syarat' => 'Minimal S1',
            'provinsi' => 'Jawa Barat',
            'kabupaten' => 'Bandung',
            'kecamatan' => 'Coblong',
            'alamat_lengkap' => 'Jl. Ganesha No. 10',
            'tanggal_mulai' => '2026-06-01',
            'tanggal_berakhir' => '2026-07-01',
        ]);

        // 4. Create a Cv
        $this->cv = Cv::create([
            'pelamar_id' => $this->pelamar->id,
            'umur' => 22,
            'tentang_saya' => 'Saya lulusan IT',
            'kontak' => '081234567890',
            'title' => 'Software Engineer CV',
            'subtitle' => 'Curriculum Vitae',
        ]);
    }

    /**
     * Test insert lamaran successfully.
     */
    public function test_insert_lamaran_success()
    {
        $response = $this->post('/lamaran/insert', [
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Lamaran berhasil dikirim',
        ]);

        $this->assertDatabaseHas('lamarans', [
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
            'status' => 'diproses',
        ]);
    }

    /**
     * Test duplicate job application fails.
     */
    public function test_insert_lamaran_duplicate_fails()
    {
        // Buat lamaran yang sudah ada terlebih dahulu
        Lamaran::create([
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
            'status' => 'diproses',
        ]);

        $response = $this->post('/lamaran/insert', [
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
        ]);

        $response->assertStatus(409);
        $response->assertJson([
            'message' => 'Anda sudah melamar lowongan ini',
        ]);
    }

    /**
     * Test validation fails when missing fields.
     */
    public function test_insert_lamaran_validation_fails()
    {
        $response = $this->post('/lamaran/insert', [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['pelamar_id', 'lowongan_id', 'cv_id']);
    }

    /**
     * Test getting CV of a logged-in pelamar.
     */
    public function test_get_cv_pelamar_success()
    {
        $response = $this->withSession(['pelamar_id' => $this->pelamar->id])
            ->get('/pelamar/cv');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'pelamar_id' => $this->pelamar->id,
            'title' => 'Software Engineer CV',
        ]);
    }

    /**
     * Test getting CV pelamar fails when unauthenticated.
     */
    public function test_get_cv_pelamar_unauthorized()
    {
        $response = $this->get('/pelamar/cv');

        $response->assertStatus(401);
    }

    /**
     * Test pelamar can view their list of applications.
     */
    public function test_pelamar_can_view_applications_list()
    {
        Lamaran::create([
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
            'status' => 'diproses',
        ]);

        $response = $this->withSession(['pelamar_id' => $this->pelamar->id])
            ->get('/lamaran-anda');

        $response->assertStatus(200);
        $response->assertViewIs('Lamaran');
        $response->assertViewHas('lamarans');
    }

    /**
     * Test history perusahaan redirects to login when guest.
     */
    public function test_history_perusahaan_redirects_when_not_logged_in()
    {
        $response = $this->get('/perusahaan/history');

        $response->assertRedirect('/login/perusahaan');
    }

    /**
     * Test history perusahaan shows processed (diterima/ditolak) applications.
     */
    public function test_history_perusahaan_shows_processed_applications()
    {
        // Lamaran diterima
        $lamaranDiterima = Lamaran::create([
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
            'status' => 'diterima',
        ]);

        // Lamaran diproses (tidak boleh muncul di history lamaran yang whereIn status diterima/ditolak)
        $lamaranDiproses = Lamaran::create([
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
            'status' => 'diproses',
        ]);

        $response = $this->withSession(['perusahaan_id' => $this->perusahaan->id])
            ->get('/perusahaan/history');

        $response->assertStatus(200);
        $response->assertViewIs('perusahaan.historyLamaran');
        $response->assertViewHas('lamarans');
        
        $lamaransInView = $response->viewData('lamarans');
        $this->assertTrue($lamaransInView->contains('id', $lamaranDiterima->id));
        $this->assertFalse($lamaransInView->contains('id', $lamaranDiproses->id));
    }

    /**
     * Test reject (tolak) application.
     */
    public function test_reject_lamaran_updates_status()
    {
        $lamaran = Lamaran::create([
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
            'status' => 'diproses',
        ]);

        $response = $this->post('/lowongan/lamaran/' . $lamaran->id . '/tolak');

        $response->assertRedirect();
        
        $lamaran->refresh();
        $this->assertEquals('ditolak', $lamaran->status);
    }

    /**
     * Test schedule interview (jadwalWawancara).
     */
    public function test_schedule_interview_and_call_external_service()
    {
        // Mock external http node service request
        Http::fake([
            'http://127.0.0.1:3001/log-wawancara' => Http::response(['status' => 'logged'], 200),
        ]);

        $lamaran = Lamaran::create([
            'pelamar_id' => $this->pelamar->id,
            'lowongan_id' => $this->lowongan->id,
            'cv_id' => $this->cv->id,
            'status' => 'diproses',
        ]);

        $response = $this->withSession(['perusahaan_id' => $this->perusahaan->id])
            ->post('/lowongan/lamaran/' . $lamaran->id . '/jadwal-wawancara', [
                'tanggal' => '2026-06-15',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:00',
                'link_meet' => 'https://meet.google.com/abc-defg-hij',
            ]);

        $response->assertRedirect();

        // 1. Cek database Lamaran status terupdate ke 'wawancara'
        $lamaran->refresh();
        $this->assertEquals('wawancara', $lamaran->status);

        // 2. Cek database Wawancara terbuat dengan benar
        $this->assertDatabaseHas('wawancaras', [
            'pelamar_id' => $this->pelamar->id,
            'perusahaan_id' => $this->perusahaan->id,
            'lowongan_id' => $this->lowongan->id,
            'status' => 'proses',
            'tanggal' => '2026-06-15',
            'jam_mulai' => '10:00',
            'jam_selesai' => '11:00',
            'link_meet' => 'https://meet.google.com/abc-defg-hij',
        ]);

        // 3. Pastikan HTTP request ke Node.js terpanggil dengan parameter yang sesuai
        Http::assertSent(function ($request) {
            return $request->url() === 'http://127.0.0.1:3001/log-wawancara' &&
                   $request['perusahaan'] === $this->perusahaan->nama_perusahaan &&
                   $request['pelamar'] === $this->pelamar->nama_lengkap &&
                   $request['room'] === 'https://meet.google.com/abc-defg-hij';
        });
    }
}
