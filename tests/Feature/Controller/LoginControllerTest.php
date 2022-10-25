<?php

namespace Tests\Feature\Controller;

use App\User;
use DatabaseSeeder;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * Test redirect to login page
     *
     * @return void
     */
    public function testRedirectLoginPage()
    {
        $response = $this->get('/');
        $response->assertRedirect(route('login'));
    }

    /**
     * Test login page
     *
     * @return void
     */
    public function testLoginPageView()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /**
     * Test login as auth user
     *
     * @return void
     */
    public function testLoginPageAsUser()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('login'));
        $response->assertRedirect(route('contacts.index'));
    }

    /**
     * Test login attempt
     *
     * @return void
     */
    public function testLoginAction()
    {
        $response = $this->post(route('login'), [
            'email' => DatabaseSeeder::TEST_USER_EMAIL,
            'password' => DatabaseSeeder::TEST_USER_PW,
        ]);

        $this->assertTrue($this->isAuthenticated());
        $response->assertRedirect(route('contacts.index'));
    }
}
