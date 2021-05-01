<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = max((int) $this->command->ask('How many users would you create?', 20), 1);
        User::factory()->exampleUser()->create();
        User::factory()->count($userCount)->create();
    }
}
