<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Perusahaan;

class R4EmailDuplikatTest extends DuskTestCase
{
    /**
     * Test Rule 4: Gagal registrasi karena email sudah terdaftar.
     */
    public function test_registrasi_email_duplikat(): void
    {
        $uniqueId = time();
        $duplicateEmail = 'salmanduplicate' . $uniqueId . '@mail.com';

        // Buat data perusahaan di database dengan email tersebut
        Perusahaan::create([
            'nama_perusahaan'   => 'Perusahaan Lama',
            'email'             => $duplicateEmail,
            'password'          => bcrypt('password123'),
            'telepon'           => '0812345678',
            'npwp'              => '12.345.678.9-' . substr($uniqueId, -4),
            'status_verifikasi' => 'verified',
        ]);

        $dummySertif = tempnam(sys_get_temp_dir(), 'sertif_') . '.pdf';
        file_put_contents($dummySertif, "%PDF-1.5\n%EOF");

        $this->browse(function (Browser $browser) use ($duplicateEmail, $dummySertif) {
            $browser->visit('/register/perusahaan')
                ->type('nama_perusahaan', 'PT Baru Salman')
                ->type('email', $duplicateEmail) // Email yang duplikat
                ->type('password', 'password123')
                ->type('telepon', '081234567800')
                ->type('npwp', '99.888.777.6-555.444')
                ->select('sektor_industri', 'Teknologi Informasi')
                ->type('alamat', 'Jl. Baru')
                ->type('deskripsi', 'Deskripsi baru')
                ->script("
                    document.getElementById('sertifikat-input').style.display = 'block';
                ");

            $browser->element('#sertifikat-input')->sendKeys(realpath($dummySertif));

            $browser->press('Daftar Sekarang')
                ->assertPathIs('/register/perusahaan')
                ->assertSee('email') // Peringatan email sudah terdaftar
                ->assertSee('sudah');
        });

        @unlink($dummySertif);
    }
}
