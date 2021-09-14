<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        
        $this->call(RolesSeeder::class);
        $this->call([UsersTableSeeder::class]);
        $this->call(CategoriesSeeder::class);
        $this->call(PermissionPostsSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(SocialNetworkSeeder::class);
        $this->call(SideBarImagesSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(VisibilitySeeder::class);
    }
}
