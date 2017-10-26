<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Lang;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegisterForm()
    {
        $this->browse(function (Browser $browser) {
            $signUpText = Lang::get('auth.sign_up');
            $browser->visit('/')
                    ->clickLink($signUpText)
                    ->waitForText($signUpText)
                    ->type('email', 'johndoe@gmail.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('submit')
                    ->waitForLocation('/verification')
                    ->assertPathIs('/verification');
        });
    }
}
