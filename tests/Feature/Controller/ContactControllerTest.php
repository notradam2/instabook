<?php

namespace Tests\Feature\Controller;

use App\User;
use Faker\Factory;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    private $user;

    /**
     * Prepare test data
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::first();
    }

    /**
     * Test contact list page
     *
     * @return void
     */
    public function testContactListPage()
    {
        $response = $this->actingAs($this->user)
            ->get(route('contacts.index'));

        $response->assertStatus(200);
    }

    /**
     * Test contact details page
     *
     * @return void
     */
    public function testContactDetailsPage()
    {
        $contact = $this->user->contacts->first();

        $response = $this->actingAs($this->user)
            ->get(route('contacts.index', [
                'contact' => $contact->id
            ]));

        $response->assertStatus(200);
    }

    /**
     * Test contact edit page
     *
     * @return void
     */
    public function testContactEditPage()
    {
        $contact = $this->user->contacts->first();

        $response = $this->actingAs($this->user)
            ->get(route('contacts.edit', [
                'contact' => $contact->id
            ]));

        $response->assertStatus(200);
    }

    /**
     * Test contact create page
     *
     * @return void
     */
    public function testContactCreatePage()
    {
        $response = $this->actingAs($this->user)
            ->get(route('contacts.create'));

        $response->assertStatus(200);
    }

    /**
     * Test create contact
     *
     * @return void
     */
    public function testCreateContact()
    {
        $faker = Factory::create();
        $email = $faker->unique()->email();

        $response = $this->actingAs($this->user)
            ->post(route('contacts.store', [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $email
            ]));

        $this->assertDatabaseHas('contacts', [
            'email' => $email
        ]);
    }

    /**
     * Test update contact
     *
     * @return void
     */
    public function testUpdateContact()
    {
        $contact = $this->user->contacts->first();

        $faker = Factory::create();
        $email = $faker->unique()->email();

        $response = $this->actingAs($this->user)
            ->put(route('contacts.update', [
                'contact' => $contact->id,
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $email
            ]));

        $this->assertDatabaseHas('contacts', [
            'email' => $email,
            'id'=> $contact->id
        ]);
    }

    /**
     * Test delete contact
     *
     * @return void
     */
    public function testDeleteContact()
    {
        $contact = $this->user->contacts->first();

        $response = $this->actingAs($this->user)
            ->delete(route('contacts.destroy', [
                'contact' => $contact->id,
            ]));

        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
            'deleted_at' => null
        ]);
    }
}
