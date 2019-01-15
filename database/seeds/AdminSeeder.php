<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {

        $adminCount = \App\Models\User::whereEmail(config('admin.email'))->count();
        if($adminCount > 0) return false; // break admin creating

        $user = factory(\App\Models\User::class)->create([
            'name' => config('admin.name'),
            'email' => config('admin.email'),
            'password' => Hash::make(config('admin.password'))
        ]);

        $user->assignRole(\App\Models\User::ROLE_ADMIN);
    }
}
