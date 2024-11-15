<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        for($i = 1; $i <= 10; $i++){
            Worker::create([
                'name' => 'worker'.$i,
                'username' => 'worker'.$i,
                'email' => 'worker'.$i,
                'phone' => '5555'.$i,
                'password' => bcrypt('123456'),
                "user_id" => 1
            ]);
        }
       
    }
}
