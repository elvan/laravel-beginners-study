<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = max((int) $this->command->ask('How many users would you create?', 9), 1);
        $exampleUser = User::factory()->exampleUser()->create();
        $exampleUser->image()->save(Image::make(['path' => "images/image-{$exampleUser->id}.png"]));

        for ($i = $userCount; $i > 0; $i--) {
            $user = User::factory()->create([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
                'api_token' => Str::random(80),
            ]);
            $user->image()->save(Image::make(['path' => "images/image-{$user->id}.png"]));
        }
    }
}
