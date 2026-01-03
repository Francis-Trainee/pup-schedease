<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);

        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin']); // Developer / top-level
        $admin = Role::create(['name' => 'admin']);             // Admin
        $faculty = Role::create(['name' => 'faculty']);         // Faculty member
        $student = Role::create(['name' => 'student']);         // Student

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all()); // super-admin gets all permissions
        $admin->givePermissionTo(['view posts', 'create posts', 'edit posts', 'delete posts']);
        $faculty->givePermissionTo(['view posts', 'create posts', 'edit posts']); // limited permissions
        $student->givePermissionTo(['view posts']); // view-only
    }
}
