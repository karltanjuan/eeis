<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            	'name'      => 'Admin',
            	'email'     => 'admin@test.com',
            	'is_admin'  => '1',
            	'is_css'	=> '0',
            	'is_epas'   => '0',
            	'password'  => bcrypt('admin123'),
            ],
            [
                'name'      => 'Simon Riley',
                'email'     => 'ghost@gmail.com',
                'is_admin'  => '0',
                'is_css'    => '0',
                'is_epas'   => '0',
                'password'  => bcrypt('ghost123'),
            ],
            // [
            // 	'name'	   => 'CSS User',
            // 	'email'    => 'css@test.com',
            //     'is_admin' => '0',
            //     'is_css'   => '1',
            //    	'is_epas'  => '0',
            //     'password' => bcrypt('css123'),
            // ],
            // [
            // 	'name'	   => 'EPAS User',
            // 	'email'    => 'epas@test.com',
            //     'is_admin' => '0',
            //     'is_css'   => '0',
            //    	'is_epas'  => '1',
            //     'password' => bcrypt('epas123'),
            // ]
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
