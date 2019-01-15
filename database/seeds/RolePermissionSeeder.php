<?php

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{

    public function run() : void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->createAdmin();

    }

    private function createAdmin() : void
    {
        if(\Spatie\Permission\Models\Role::whereName(\App\Models\User::ROLE_ADMIN)->count() < 1) {
            \Spatie\Permission\Models\Role::create(['name' => \App\Models\User::ROLE_ADMIN]);
        }
    }
}
