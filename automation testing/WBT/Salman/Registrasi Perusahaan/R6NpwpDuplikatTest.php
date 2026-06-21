<?php

namespace Tests\WBT\Salman\RegistrasiPerusahaan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Perusahaan;

class R6NpwpDuplikatTest extends TestCase
{
    use RefreshDatabase;

    private $duplicateNpwp = '00.000.000.0-000.789';

    protected function setUp(): void
    {
        parent::setUp();

        // Buat data perusahaan di database dengan NPWP tersebut
        Perusahaan::create([
            'nama_perusahaan'   => 'Perusahaan Lama',
            'email'             => 'oldcompany@mail.com',
            'password'          => bcrypt('password123'),
            'telepon'           => '0812345678',
            'npwp'              => $this->duplicateNpwp, // NPWP duplikat
            'status_verifikasi' => 'verified',
        ]);
    }

    /**
     * WBT R6: Gagal registrasi karena NPWP sudah terdaftar.
     */
    public function test_registrasi_npwp_duplikat(): void
    {
        $response = $this->post('/register/perusahaan', [
            'nama_perusahaan' => 'PT Baru Salman',
            'email'           => 'newcompany@mail.com',
            'password'        => 'password123',
            'telepon'         => '081234567800',
            'npwp'            => $this->duplicateNpwp, // NPWP duplikat
            'sektor_industri' => 'Teknologi Informasi',
            'alamat'          => 'Jl. Baru',
            'deskripsi'         => 'Deskripsi baru',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['npwp']);
    }
}
