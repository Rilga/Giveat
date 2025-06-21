<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DonasiLocationTest extends DuskTestCase
{
    /**
     * @group donasilocations
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(4); // Sesuaikan ID user valid di database

            $browser->loginAs($user)
                    ->visit('/dashboard')
                    ->assertSee('Siap Makan Hari Ini')
                    ->pause(1000)

                    // Klik tombol Ambil berdasarkan attribute dusk
                    ->click('@order')
                    ->pause(1000)

                    // Klik tombol/link buka Google Maps
                    ->click('@open-maps');
        });
    }
}
