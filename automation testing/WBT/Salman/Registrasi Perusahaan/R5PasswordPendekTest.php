<?php

namespace Tests\WBT\Salman\RegistrasiPerusahaan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class R5PasswordPendekTest extends TestCase
{
    use RefreshDatabase;

    /**
     * WBT R5: Gagal registrasi karena password kurang dari 6 karakter.
     */
    public function test_registrasi_password_pendek(): void
    {
        $response = $this->post('/register/perusahaan', [
            'nama_perusahaan' => 'PT Salman Tekno',
            'email'           => 'salmanreg@mail.com',
            'password'        => '12345', // Hanya 5 karakter
            'telepon'         => '081234567890',
            'npwp'            => '00.123.456.7-890.123',
            'sektor_industri' => 'Teknologi Informasi',
            'alamat'          => 'Jl. Alamat',
            'deskripsi'       => 'Deskripsi singkat',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password']);
    }
}
