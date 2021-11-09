<?php

use App\User;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
            $data[$i] = [
                'id_user' => 'USR-2021000'. $i,
                'name'    => 'user'. $i,
                'email'    => 'user'. $i .'@user.id',
                'password'    => bcrypt('user'),
                'role' => '0'
            ];
        }
        
        User::insert($data);
    }
}
