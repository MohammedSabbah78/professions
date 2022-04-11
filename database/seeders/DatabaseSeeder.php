<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();




        // Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Permissions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Permissions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Permissions', 'guard_name' => 'admin']);



        // Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Categories', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-SubCategory', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-SubCategories', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-SubCategory', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-SubCategory', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-FavoriteProfession', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-FavoriteProfessions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-FavoriteProfession', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Profession', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Professions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Profession', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Profession', 'guard_name' => 'admin']);




        // Role::create(['name' => 'Super-Admin', 'guard_name' => 'admin']);
        // Role::create(['name' => 'Content Manegment', 'guard_name' => 'admin']);
        // Role::create(['name' => 'HR', 'guard_name' => 'admin']);


        // -----For User-----
        // Permission::create(['name' => 'Create-Profession', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Read-Professions', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Update-Profession', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Delete-Profession', 'guard_name' => 'user']);

        // Permission::create(['name' => 'Create-FavoriteProfession', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-FavoriteProfessions', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-FavoriteProfession', 'guard_name' => 'admin']);
    }
}
