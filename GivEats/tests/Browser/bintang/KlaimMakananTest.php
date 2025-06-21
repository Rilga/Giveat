<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class KlaimMakananTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group klaimmakanan
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(4); 
            $browser->loginAs($user) // Ganti dengan ID user yang sesuai
                    ->visit('/donations/1')
                    ->pause(2000)
                    ->assertSee('Sop Ayam dan Sayur')
                    ->pause(2000)
                    ->press('Ambil Makananmu')
                    ->pause(2000)
                    ->assertPathIs('/claim/success/default-slug')
                    ->pause(2000)
                    ->press('Kembali ke Beranda')
                    ->pause(2000)
                    ->press('Batalkan Pemesanan')
                    ->pause(2000)
                    ->acceptDialog()
                    ->pause(2000)
                    ->click('a[href^="https://maps.app.goo.gl/iDKgFx7JW1ppqdEB6"]')
                    ->pause(5000);
                    
        });
    }
}
