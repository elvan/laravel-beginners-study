<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = max((int) $this->command->ask('How many users would you create?', 65), 1);
        $exampleUser = User::factory()->exampleUser()->create();
        $exampleUser->image()->save(Image::make(['path' => "diverseui/image-{$exampleUser->id}.png"]));

        for ($i = $userCount; $i > 0; $i--) {
            $user = User::factory()->create([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
            ]);
            $user->image()->save(Image::make(['path' => "diverseui/image-{$user->id}.png"]));
        }
    }
}
