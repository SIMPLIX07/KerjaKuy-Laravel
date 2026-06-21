<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Perusahaan;

class R3TglMulaiInvalidTest extends DuskTestCase
{
    /**
     * Test Rule 3: Gagal membuat lowongan karena format Tanggal Mulai tidak valid (kosong).
     */
    public function test_membuat_lowongan_tgl_mulai_invalid(): void
    {
        $uniqueId = time();
        $email = 'salmanperusahaan' . $uniqueId . '@mail.com';

        $perusahaan = Perusahaan::create([
            'nama_perusahaan'   => 'PT Salman Sukses ' . $uniqueId,
            'email'             => $email,
            'password'          => bcrypt('password123'),
            'telepon'           => '0812345678',
            'npwp'              => '12.345.678.9-' . substr($uniqueId, -4),
            'status_verifikasi' => 'verified',
        ]);

        $this->browse(function (Browser $browser) use ($email) {
            $browser->visit('/login/perusahaan')
                ->type('email', $email)
                ->type('password', 'password123')
                ->press('Masuk')
                ->waitForLocation('/home-perusahaan')
                
                ->visit('/lowongan/tambah')
                ->waitForText('Tambah Lowongan')
                ->type('kategori', 'Teknologi')
                ->type('posisi', 'Developer Salman')
                ->select('jenis', 'Full-time')
                ->type('gaji', 'Rp 12.000.000')
                ->type('deskripsi_singkat', 'Dusk automated test short description.')
                ->type('deskripsi', 'Dusk automated test long description details.')
                ->type('syarat', 'PHP, Laravel, Dusk, testing.')
                ->type('pendidikan', 'S1 Teknik Informatika')
                ->type('pengalaman', 'Minimal 1 tahun')
                ->type('keahlian_teknis', 'Laravel, Dusk')
                ->type('provinsi', 'Jawa Barat')
                ->type('kota', 'Bandung')
                ->type('kecamatan', 'Coblong')
                ->type('alamat', 'Jl. Ganesha No. 10');

            // Set tanggal_akhir saja, tapi kosongkan tanggal_mulai
            $browser->script("
                document.getElementsByName('tanggal_mulai')[0].value = '';
                document.getElementsByName('tanggal_akhir')[0].value = '2026-07-07';
            ");

            $browser->press('Buat')
                ->waitForText('The tanggal mulai field is required.')
                ->assertPathIs('/lowongan/tambah')
                ->assertSee('The tanggal mulai field is required.');
        });
    }
}
