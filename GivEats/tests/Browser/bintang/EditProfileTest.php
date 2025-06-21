<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditProfileTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group editprofile
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::find(18); 

            $browser->loginAs($user) // Ganti dengan ID user yang sesuai
            ->visit('/profile')
            ->assertPathIs('/profile')
            ->visit('/profile')
            ->press('@ganti')
            ->attach('image', storage_path('app/public/profile/profile1.jpg')) // 'foto' = name atau id dari input file
            ->type('name', 'Bintang Preciosa')
            ->pause(2000)
            ->type('city', 'Bandung')
            ->press('SAVE')
            ->pause(2000)
            ->type('current_password', 'bintang123') 
            ->pause(2000)
            ->type('password', 'bintang12345') 
            ->pause(2000)
            ->type('password_confirmation', 'bintang12345') 
            ->pause(100)
            ->press('SAVE')
            ->waitFor('@delete-account-button')
            ->press('@delete-account-button')
            ->whenAvailable('form[action*="profile"]', function ($modal) {
                $modal->type('password', 'bintang123')
                    ->press('@confirm-delete-account');
            })
            ->pause(1000);
            });
    }
}
