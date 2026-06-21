<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Perusahaan;

class R1ValidLengkapTest extends DuskTestCase
{
    /**
     * Test Rule 1: Registrasi Perusahaan dengan data valid dan lengkap (termasuk Foto Profil & Website).
     */
    public function test_registrasi_valid_lengkap(): void
    {
        $uniqueId = time();
        $email = 'salmanreg' . $uniqueId . '@mail.com';
        $npwp = '00.000.000.0-000.' . substr($uniqueId, -3);

        // Buat berkas dummy untuk diupload
        $dummySertif = tempnam(sys_get_temp_dir(), 'sertif_') . '.pdf';
        file_put_contents($dummySertif, "%PDF-1.5\n%EOF");

        $dummyPhoto = tempnam(sys_get_temp_dir(), 'photo_') . '.jpg';
        file_put_contents($dummyPhoto, "dummy image content");

        $this->browse(function (Browser $browser) use ($email, $npwp, $dummySertif, $dummyPhoto) {
            $browser->visit('/register/perusahaan')
                ->type('nama_perusahaan', 'PT Salman Tekno Lengkap')
                ->type('email', $email)
                ->type('password', 'password123')
                ->type('telepon', '081234567890')
                ->type('npwp', $npwp)
                ->select('sektor_industri', 'Teknologi Informasi')
                ->type('alamat', 'Jl. Sudirman No. 12, Jakarta')
                ->type('deskripsi', 'Perusahaan teknologi yang bergerak di bidang software.')
                ->type('website', 'https://salmantekno.com')
                ->script("
                    document.getElementById('foto-profil-input').style.display = 'block';
                    document.getElementById('sertifikat-input').style.display = 'block';
                ");

            $browser->element('#foto-profil-input')->sendKeys(realpath($dummyPhoto));
            $browser->element('#sertifikat-input')->sendKeys(realpath($dummySertif));

            $browser->press('Daftar Sekarang')
                ->waitForLocation('/login/perusahaan')
                ->assertSee('Registrasi berhasil! Tunggu verifikasi dari admin');
        });

        // Bersihkan berkas dummy
        @unlink($dummySertif);
        @unlink($dummyPhoto);
    }
}
