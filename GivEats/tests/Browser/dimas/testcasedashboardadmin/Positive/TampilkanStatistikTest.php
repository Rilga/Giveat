<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TampilkanStatistikTest extends DuskTestCase
{
    /**
     * @group statistik
     */
    public function testExample(): void
    {
        $user = \App\Models\User::find(1); // ganti dengan ID admin

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/admin/dashboard')
                    ->assertSee('Jumlah Mitra')
                    ->assertSee('Jumlah User');
        });
    }
} 
