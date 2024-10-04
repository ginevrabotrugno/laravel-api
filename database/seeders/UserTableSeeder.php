<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users = [
            ['name' => 'Admin', 'email' => 'admin@admin.it', 'password' => Hash::make('321321321')],
            ['name' => 'Admina', 'email' => 'admina@admina.it', 'password' => Hash::make('321321321')]
       ];

       foreach($users as $user){
            User::create($user);
       }
    }
}
