<?php

namespace Tests\WBT\Salman\RegistrasiPerusahaan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class R7SertifikatInvalidTest extends TestCase
{
    use RefreshDatabase;

    /**
     * WBT R7: Gagal registrasi karena file sertifikat tidak valid (format TXT bukan PDF/JPG/PNG).
     */
    public function test_registrasi_sertifikat_invalid(): void
    {
        $invalidSertif = UploadedFile::fake()->create('sertifikat.txt', 100, 'text/plain');

        $response = $this->post('/register/perusahaan', [
            'nama_perusahaan' => 'PT Salman Tekno',
            'email'           => 'salmanreg@mail.com',
            'password'        => 'password123',
            'telepon'         => '081234567890',
            'npwp'            => '00.000.000.0-000.123',
            'sektor_industri' => 'Teknologi Informasi',
            'alamat'          => 'Jl. Alamat',
            'deskripsi'       => 'Deskripsi singkat',
            'sertifikat'      => $invalidSertif, // Berkas TXT tidak valid
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['sertifikat']);
    }
}
