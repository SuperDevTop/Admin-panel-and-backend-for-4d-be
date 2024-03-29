<?php

namespace Database\Seeders;

use App\Models\Limit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\RankNumber;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret'),
            'phoneNumber' => '1111111111'
        ]);

        $companies = ['m', 'd', 't', 'g'];

        for ($j = 0; $j < 4; $j++) { 
            # code...
            for($i = 0; $i < 23; $i++)
            {
                $ranknumber = new RankNumber();
                $ranknumber->company = $companies[$j];
                $ranknumber->rank = $i + 1;

                if($i > 2 && $i < 13) // Rank 4: 10( Rank 1, 2, 3: 1)
                {
                    $ranknumber->rank = 4;
                }
                elseif($i >= 13)
                {
                    $ranknumber->rank = 5;
                }

                $rand_num = rand(0, 9999);
                $rand_num = strval($rand_num);
                $rand_num = str_pad($rand_num, 4, '0', STR_PAD_LEFT);

                $ranknumber->ranknumber = $rand_num;

                $ranknumber->save();
            }
        }


        $limit = new Limit();
        $limit->big = 50;
        $limit->small = 50;
        $limit->sold_out_big = 100;
        $limit->sold_out_small = 100;
        $limit->save();

    }
}
