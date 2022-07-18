<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ['superadmin@brocar.id', 'seller@brocar.id', 'agent@brocar.id', 'adminseller@brocar.id', 'adminoprational@brocar.id'];

        foreach ($users as $key => $email) {
            $user = new User([
                'role_id' => $key + 1,
                'email' => $email,
                'password' => Hash::make('qwerty123'),
                'verified_at' => Carbon::now()->toDateTime()
            ]);
            $user->save();
        }
    }
}
