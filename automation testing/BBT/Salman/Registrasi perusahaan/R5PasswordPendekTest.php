<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class R5PasswordPendekTest extends DuskTestCase
{
    /**
     * Test Rule 5: Gagal registrasi karena password kurang dari 6 karakter.
     */
    public function test_registrasi_password_pendek(): void
    {
        $uniqueId = time();
        $email = 'salmanreg' . $uniqueId . '@mail.com';

        $dummySertif = tempnam(sys_get_temp_dir(), 'sertif_') . '.pdf';
        file_put_contents($dummySertif, "%PDF-1.5\n%EOF");

        $this->browse(function (Browser $browser) use ($email, $dummySertif) {
            $browser->visit('/register/perusahaan')
                ->type('nama_perusahaan', 'PT Salman Tekno')
                ->type('email', $email)
                ->type('password', '12345') // Hanya 5 karakter
                ->type('telepon', '081234567890')
                ->type('npwp', '00.123.456.7-890.123')
                ->select('sektor_industri', 'Teknologi Informasi')
                ->type('alamat', 'Jl. Alamat')
                ->type('deskripsi', 'Deskripsi singkat')
                ->script("
                    document.getElementById('sertifikat-input').style.display = 'block';
                ");

            $browser->element('#sertifikat-input')->sendKeys(realpath($dummySertif));

            $browser->press('Daftar Sekarang')
                ->assertPathIs('/register/perusahaan')
                ->assertSee('password') // Pesan error password minimal 6 karakter
                ->assertSee('minimal');
        });

        @unlink($dummySertif);
    }
}
