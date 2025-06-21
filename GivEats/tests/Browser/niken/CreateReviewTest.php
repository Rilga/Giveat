<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateReviewTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group createreview
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(4); 

            $browser->loginAs($user)
                    ->visit('/reviews')
                    ->click('@buat')
                    ->type('nama_restoran', 'Jabarano')
                    ->type('nama_hidangan', 'Matcha Latte')
                    ->pause(2000)                 
                    ->click('label[for="star5"]')
                    ->type('deskripsi_ulasan', 'Sangat Enak!')
                    ->click('@kirim');
        });
    }
}