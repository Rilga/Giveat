<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Donation;
use App\Models\Partner;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Carbon\Carbon;

class DashboardPositiveTest extends DuskTestCase
{
    /**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */
    public function test_statistiksebelum()
    {
        // Mulai sesi browser untuk pengujian
        $this->browse(function (Browser $browser) {
            
            // Ambil pengguna (diasumsikan pengguna dengan ID 2 ada) untuk login
            $user = \App\Models\User::find(5);
            // Login pengguna dan kunjungi halaman history
            $browser->loginAs($user)
            ->visit('/mitra/dashboard')
            ->pause(2000)
            ->assertSee('Dashboard') // Make sure 'Dashboard' is present
            ->assertSee('Total Pesanan') // Make sure "Total Pesanan" is present
            ->assertSee('Penerima Makanan') // Make sure "Penerima Makanan" is present
            ->assertSee('Kg Makanan Terselamatkan'); // Make sure "Kg Makanan Terselamatkan" is present
        });
    }
/**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */
    public function test_create_donation()
    {
        // Mulai sesi browser untuk pengujian
        $this->browse(function (Browser $browser) {
            
            // Ambil pengguna (diasumsikan pengguna dengan ID 2 ada) untuk login
            $user = \App\Models\User::find(5);

            // Ambil kategori pertama atau buat kategori baru jika tidak ada
            $category = \App\Models\Category::first() ?? \App\Models\Category::factory()->create();

            // Login pengguna dan kunjungi halaman donasi
            $browser->loginAs($user)
                ->visit('/mitra/donations') // Navigasi ke halaman donasi
                ->clickLink('Tambah Donasi') // Klik link untuk menambah donasi baru
                ->type('name', 'Donasi Makanan') // Isi field 'name' dengan 'Donasi Makanan'
                ->select('category_id', $category->id) // Pilih kategori untuk donasi
                ->type('description', 'Deskripsi donasi makanan') // Isi field 'description' dengan deskripsi donasi
                ->type('portion', 3) // Isi field 'portion' dengan jumlah 3
                ->type('location', 'Bandung') // Isi field lokasi dengan 'Bandung'
                ->attach('image', public_path('images/testing/test.jpg')); // Lampirkan file gambar palsu untuk donasi

            // Set waktu pickup ke satu hari dari sekarang menggunakan Carbon untuk menghasilkan datetime
            $datetime = now()->addDay()->format('Y-m-d\TH:i');
            $browser->script([
                // Set waktu pickup menggunakan JavaScript untuk berinteraksi dengan field input
                "document.querySelector('[name=\"pickup_time\"]').value = '{$datetime}';"
            ]);

            // Tekan tombol 'Tambah Makanan' untuk mengirimkan formulir
            $browser->press('Tambah Makanan');
                // Pastikan pesan sukses muncul setelah pengiriman
        });
    } 
         /**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */
    public function testKlaimDonasi(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(4); 
            $browser->loginAs($user) // Ganti dengan ID user yang sesuai
                    ->visit('/dashboard')
                    ->pause(2000)
                    ->click('@order')
                    ->press('Ambil Makanan')
                    ->pause(2000);
                    
        });
    }
          /**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */

    public function test_statistik()
    {
        // Mulai sesi browser untuk pengujian
        $this->browse(function (Browser $browser) {
            
            // Ambil pengguna (diasumsikan pengguna dengan ID 2 ada) untuk login
            $user = \App\Models\User::find(5);
            // Login pengguna dan kunjungi halaman history
            $browser->loginAs($user)
            ->pause(2000)
            ->visit('/mitra/dashboard')
            ->assertSee('Dashboard') // Make sure 'Dashboard' is present
            ->assertSee('Total Pesanan') // Make sure "Total Pesanan" is present
            ->assertSee('Penerima Makanan') // Make sure "Penerima Makanan" is present
            ->assertSee('Kg Makanan Terselamatkan'); // Make sure "Kg Makanan Terselamatkan" is present
        });
    }
/**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */
    public function test_daftar_pesanan()
    {
        // Mulai sesi browser untuk pengujian
        $this->browse(function (Browser $browser) {
            
            // Ambil pengguna (diasumsikan pengguna dengan ID 2 ada) untuk login
            $user = \App\Models\User::find(5);
            // Login pengguna dan kunjungi halaman history
            $browser->loginAs($user)
            ->visit('/mitra/dashboard')
            ->assertSee('No') // Ensure it is visible
            ->assertSee('Pesanan') // Ensure the user's  booking code is visible
            ->assertSee('Nama') // Ensure the claimed name is visible
            ->assertSee('Waktu') // Ensure the claimed date is visible
            ->assertSee('Tanggal'); // Ensure the claimed date is visible
        });
    }

    /**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */
    public function test_status_pesanan()
    {
        // Mulai sesi browser untuk pengujian
        $this->browse(function (Browser $browser) {
            
            // Ambil pengguna (diasumsikan pengguna dengan ID 2 ada) untuk login
            $user = \App\Models\User::find(5);
            // Login pengguna dan kunjungi halaman history
            $browser->loginAs($user)
            ->visit('/mitra/dashboard')
            ->assertSee('Selesai') // Ensure done status is visible
            ->assertSee('Belum Diambil') // Ensure not yet picked is visible
            ->assertSee('Tidak Diambil'); // Ensure not picked is visible
        });
    }
    /**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */
    public function test_daftar_donasi()
    {
        // Mulai sesi browser untuk pengujian
        $this->browse(function (Browser $browser) {
            
            // Ambil pengguna (diasumsikan pengguna dengan ID 2 ada) untuk login
            $user = \App\Models\User::find(5);
            // Login pengguna dan kunjungi halaman history
            $browser->loginAs($user)
            ->visit('/mitra/dashboard')
            ->assertSee('Makanan'); // Ensure "Makanan" is visible
        });
    }

      /**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */
    public function testClaimed(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(4); 
            $browser->loginAs($user) // Ganti dengan ID user yang sesuai
                    ->visit('/dashboard')
                    ->pause(2000)
                    ->click('@order')
                    ->press('Ambil Makanan')
                    ->pause(2000);
                    
        });
    }
          /**
     * Contoh uji coba Dusk.
     * @group positivedashboardmitra
     */

    public function test_statistik_gagal()
    {
        // Mulai sesi browser untuk pengujian
        $this->browse(function (Browser $browser) {
            
            // Ambil pengguna (diasumsikan pengguna dengan ID 2 ada) untuk login
            $user = \App\Models\User::find(5);
            // Login pengguna dan kunjungi halaman history
            $browser->loginAs($user)
            ->pause(2000)
            ->visit('/mitra/dashboard')
            ->assertSee('Dashboard') // Make sure 'Dashboard' is present
            ->assertSee('Total Pesanan') // Make sure "Total Pesanan" is present
            ->assertSee('Penerima Makanan') // Make sure "Penerima Makanan" is present
            ->assertSee('Kg Makanan Terselamatkan'); // Make sure "Kg Makanan Terselamatkan" is present
        });
    }
}
