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
    public function testFormWithRightData()
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
    }

    public function testFormWithEmptyData()
    {
        $this->browse(function(Browser $browser) {
            $emailError = Lang::get('validation.required', ['attribute' => 'email']);
            $passwordError = Lang::get('validation.required', ['attribute' => 'password']);

            $browser->visit('/auth/register')
                ->press('submit')
                ->waitFor("label[data-error]", 1);

            $displayedEmailError = $browser->attribute('label[for=email]', 'data-error');
            $displayedPasswordError = $browser->attribute('label[for=password]', 'data-error');
            $buttonDisabledAttr = $browser->attribute('button[name=submit]', 'disabled');

            $this->assertEquals('invalid', $browser->attribute('input#email', 'class'));
            $this->assertEquals('invalid', $browser->attribute('input#password', 'class'));
            $this->assertEquals($passwordError, $displayedPasswordError);
            $this->assertEquals($emailError, $displayedEmailError);
            $this->assertEquals('true', $buttonDisabledAttr);
        });
    }

    public function testFormWithWrongData()
    {
        $email = 'john@a';
        $this->browse(function (Browser $browser) use ($email) {
            $emailError = Lang::get('validation.email', ['attribute' => 'email']);
            $passwordError = Lang::get('validation.confirmed', ['attribute' => 'password']);

            $browser->visit('/auth/register')
                ->type('email', $email)
                ->type('password', '123456')
                ->type('password_confirmation', '1234567')
                ->press('submit')
                ->waitFor("label[data-error]");

            $displayedEmailError = $browser->attribute('label[for=email]', 'data-error');
            $displayedPasswordError = $browser->attribute('label[for=password]', 'data-error');
            $this->assertEquals($passwordError, $displayedPasswordError);
            $this->assertEquals($emailError, $displayedEmailError);
        });
    }
}
