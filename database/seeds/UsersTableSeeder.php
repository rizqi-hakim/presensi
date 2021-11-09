<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id_user' => 'ADM-20210001',
            'name'    => 'admin',
            'email'    => 'admin@admin.id',
            'password'    => bcrypt('admin'),
            'role' => '1'
        ]);
    }
}
