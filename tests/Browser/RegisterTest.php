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
     * Test register form with right data.
     *
     * @return void
     */
    public function testRegisterFormWithRightData()
    {
        $email = 'johndoe@gmail.com';
        $this->browse(function (Browser $browser) use ($email) {
            $signUpText = Lang::get('auth.sign_up');

            $browser->visit('/')
                ->clickLink($signUpText)
                ->waitForText($signUpText)
                ->type('email', $email)
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('submit')
                ->waitForLocation('/verification')
                ->assertPathIs('/verification')
                ->assertSee(Lang::get('auth.verification_message'));
        });

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'email_token' => base64_encode($email),
        ]);
    }

    public function testRegisterFormWithWrongData()
    {
        $this->browse(function(Browser $browser) {
            $emailText = Lang::get('validation.required', ['attribute' => 'email']);
            $browser->visit('/auth/register')
                ->press('submit')
                ->waitForText($emailText)
                ->assertSee($emailText)
                ->assertSee(Lang::get('validation.required', ['attribute' => 'password']));
        });
    }
}
