<?php

namespace Database\Seeds;

use App\Models\Contact;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public const TEST_USER_NAME = 'Dim';
    public const TEST_USER_EMAIL = 'admin@test.com';
    public const TEST_USER_PW = 'admin12345';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->seedTestUser();
        $this->seedTestContacts($user);
    }

    /**
     * Seed test user
     *
     * @return User
     */
    private function seedTestUser(): User
    {
        return factory(User::class)->create([
            'name' => self::TEST_USER_NAME,
            'email' => self::TEST_USER_EMAIL,
            'password' => Hash::make(self::TEST_USER_PW)
        ]);
    }

    /**
     * Seed test contacts
     *
     * @param User $user
     * @return void
     */
    private function seedTestContacts(User $user): void
    {
        factory(Contact::class, 10)->create([
            'user_id' => $user->id
        ]);
    }
}
