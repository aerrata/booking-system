<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::create(['name' => 'create rooms']);
        Permission::create(['name' => 'edit rooms']);
        Permission::create(['name' => 'delete rooms']);

        Permission::create(['name' => 'create bookings']);
        Permission::create(['name' => 'edit bookings']);
        Permission::create(['name' => 'delete bookings']);
        Permission::create(['name' => 'approve bookings']);

        // Roles
        $roleUser = Role::create(['name' => 'user'])
            ->givePermissionTo(['create booking', 'edit booking']);

        $roleManager = Role::create(['name' => 'manager'])
            ->givePermissionTo('create rooms', 'edit rooms', 'delete rooms', 'approve bookings');

        $roleAdmin = Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        // Users
        $userUser = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'user@domain.com',
        ]);
        $userUser->assignRole($roleUser);

        $userManager = \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@domain.com',
        ]);
        $userManager->assignRole($roleManager);

        $userAdmin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
        ]);
        $userAdmin->assignRole($roleAdmin);
    }
}
