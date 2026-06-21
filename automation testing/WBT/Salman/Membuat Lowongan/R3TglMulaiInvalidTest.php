<?php

namespace Tests\WBT\Salman\MembuatLowongan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Perusahaan;

class R3TglMulaiInvalidTest extends TestCase
{
    use RefreshDatabase;

    private $perusahaan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->perusahaan = Perusahaan::create([
            'nama_perusahaan'   => 'PT Salman WBT Tekno',
            'email'             => 'salmanwbt@mail.com',
            'password'          => bcrypt('password123'),
            'telepon'           => '081234567890',
            'npwp'              => '12.345.678.9-000.000',
            'status_verifikasi' => 'verified',
        ]);
    }

    /**
     * WBT R3: Gagal membuat lowongan karena format tanggal mulai tidak valid
     */
    public function test_store_lowongan_tanggal_mulai_invalid(): void
    {
        $response = $this->withSession(['perusahaan_id' => $this->perusahaan->id])
            ->post('/lowongan/tambah', [
                'kategori'          => 'Teknologi Informasi',
                'posisi'            => 'WBT Specialist',
                'jenis'             => 'Full-time',
                'gaji'              => '10000000',
                'deskripsi_singkat' => 'Bekerja dengan PHPUnit',
                'deskripsi'         => 'Mengembangkan test case backend',
                'syarat'            => 'Menguasai Laravel & PHPUnit',
                'provinsi'          => 'Jawa Barat',
                'kota'              => 'Bandung',
                'kecamatan'         => 'Coblong',
                'alamat'            => 'Jl. Dago No. 12',
                'tanggal_mulai'     => 'bukan-tanggal-valid', // Format salah
                'tanggal_akhir'     => '2026-07-21',
                'pendidikan'        => 'S1',
                'pengalaman'        => '1-3 Tahun',
                'keahlian_teknis'   => 'PHP, Laravel',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['tanggal_mulai']);
    }
}
