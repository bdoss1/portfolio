<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {

        $adminCount = \App\Models\User::whereEmail(config('admin.user_email'))->count();
        if($adminCount > 0) return false; // break admin creating

        $user = factory(\App\Models\User::class)->create([
            'name' => config('admin.user_name'),
            'email' => config('admin.user_email'),
            'password' => Hash::make(config('admin.user_password'))
        ]);

        $user->assignRole(\App\Models\User::ROLE_ADMIN);
    }
}
