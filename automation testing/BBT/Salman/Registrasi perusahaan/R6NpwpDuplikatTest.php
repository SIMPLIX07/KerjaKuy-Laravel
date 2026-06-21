<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Perusahaan;

class R6NpwpDuplikatTest extends DuskTestCase
{
    /**
     * Test Rule 6: Gagal registrasi karena NPWP sudah terdaftar.
     */
    public function test_registrasi_npwp_duplikat(): void
    {
        $uniqueId = time();
        $duplicateNpwp = '00.000.000.0-000.' . substr($uniqueId, -3);

        // Buat data perusahaan di database dengan NPWP tersebut
        Perusahaan::create([
            'nama_perusahaan'   => 'Perusahaan Lama',
            'email'             => 'oldcompany' . $uniqueId . '@mail.com',
            'password'          => bcrypt('password123'),
            'telepon'           => '0812345678',
            'npwp'              => $duplicateNpwp, // NPWP yang duplikat
            'status_verifikasi' => 'verified',
        ]);

        $dummySertif = tempnam(sys_get_temp_dir(), 'sertif_') . '.pdf';
        file_put_contents($dummySertif, "%PDF-1.5\n%EOF");

        $this->browse(function (Browser $browser) use ($duplicateNpwp, $dummySertif, $uniqueId) {
            $browser->visit('/register/perusahaan')
                ->type('nama_perusahaan', 'PT Baru Salman')
                ->type('email', 'newcompany' . $uniqueId . '@mail.com')
                ->type('password', 'password123')
                ->type('telepon', '081234567800')
                ->type('npwp', $duplicateNpwp) // NPWP duplikat
                ->select('sektor_industri', 'Teknologi Informasi')
                ->type('alamat', 'Jl. Baru')
                ->type('deskripsi', 'Deskripsi baru')
                ->script("
                    document.getElementById('sertifikat-input').style.display = 'block';
                ");

            $browser->element('#sertifikat-input')->sendKeys(realpath($dummySertif));

            $browser->press('Daftar Sekarang')
                ->assertPathIs('/register/perusahaan')
                ->assertSee('npwp') // Peringatan NPWP sudah terdaftar
                ->assertSee('sudah');
        });

        @unlink($dummySertif);
    }
}
