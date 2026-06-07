<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Pelamar;
use App\Models\Portofolio;

class PortofolioTest extends TestCase
{
    use RefreshDatabase;

    private $pelamar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pelamar = Pelamar::create([
            'nama_lengkap' => 'Budi Portofolio',
            'username'     => 'budiport',
            'email'        => 'budi.port@mail.com',
            'password'     => bcrypt('password123'),
        ]);
    }

    /**
     * Test index page displays portfolio.
     */
    public function test_portofolio_index_page()
    {
        $response = $this->get('/portofolio');
        $response->assertRedirect('/login/pelamar');

        Portofolio::create([
            'pelamar_id'    => $this->pelamar->id,
            'judul'         => 'Sistem Informasi E-Commerce',
            'kategori'      => 'Web Development',
            'deskripsi'     => 'Membuat toko online',
            'teknologi'     => 'Laravel, Vue',
            'link_demo'     => 'https://demo.com',
            'link_repo'     => 'https://github.com',
            'tanggal_mulai' => '2026-01-01',
            'tanggal_selesai' => '2026-03-01',
        ]);

        $response = $this->withSession(['pelamar_id' => $this->pelamar->id])
            ->get('/portofolio');

        $response->assertStatus(200);
        $response->assertViewIs('indexPortofolio');
        $response->assertViewHas('portofolios');
        $this->assertEquals(1, $response->viewData('portofolios')->count());
    }

    /**
     * Test create portofolio page.
     */
    public function test_create_portofolio_page()
    {
        $response = $this->get('/portofolio/create');
        $response->assertRedirect('/login/pelamar');

        $response = $this->withSession(['pelamar_id' => $this->pelamar->id])
            ->get('/portofolio/create');
        
        $response->assertStatus(200);
        $response->assertViewIs('portofolio.tambahPortofolio');
        $response->assertViewHas('pelamar');
    }

    /**
     * Test store portofolio successfully.
     */
    public function test_store_portofolio_success()
    {
        $response = $this->withSession(['pelamar_id' => $this->pelamar->id])
            ->post('/portofolio', [
                'judul'           => 'Aplikasi Deteksi Objek',
                'kategori'        => 'AI / Machine Learning',
                'deskripsi'       => 'Sistem pendeteksi objek berbasis Python.',
                'teknologi'       => 'Python, OpenCV, YOLO',
                'link_demo'       => 'https://demo-ai.com',
                'link_repo'       => 'https://github.com/ai-detect',
                'tanggal_mulai'   => '2026-02-01',
                'tanggal_selesai' => '2026-05-01',
            ]);

        $response->assertRedirect('/portofolio');
        $response->assertSessionHas('success', 'Portofolio berhasil disimpan');

        $this->assertDatabaseHas('portofolios', [
            'pelamar_id'      => $this->pelamar->id,
            'judul'           => 'Aplikasi Deteksi Objek',
            'tanggal_selesai' => '2026-05-01',
        ]);
    }

    /**
     * Test store portofolio validation fails.
     */
    public function test_store_portofolio_validation_fails()
    {
        // Judul kosong, dan tanggal_selesai sebelum tanggal_mulai
        $response = $this->withSession(['pelamar_id' => $this->pelamar->id])
            ->post('/portofolio', [
                'judul'           => '',
                'tanggal_mulai'   => '2026-05-01',
                'tanggal_selesai' => '2026-02-01',
            ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['judul', 'tanggal_selesai']);
    }

    /**
     * Test delete portofolio.
     */
    public function test_delete_portofolio_success()
    {
        $portofolio = Portofolio::create([
            'pelamar_id' => $this->pelamar->id,
            'judul'      => 'Aplikasi Mobile',
        ]);

        $response = $this->withSession(['pelamar_id' => $this->pelamar->id])
            ->delete('/portofolio/' . $portofolio->id);

        $response->assertRedirect('/portofolio');
        $response->assertSessionHas('success', 'Portofolio berhasil dihapus');

        $this->assertDatabaseMissing('portofolios', ['id' => $portofolio->id]);
    }
}
