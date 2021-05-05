<?php

namespace Database\Seeders;

use Database\Seeders\BlogPostSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\TagsSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the database?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }

        $this->call([
            UserSeeder::class,
            BlogPostSeeder::class,
            CommentSeeder::class,
            TagsSeeder::class,
            BlogPostTagSeeder::class,
        ]);
    }
}
