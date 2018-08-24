<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test')->delete();

        for ($i=0; $i < 10; $i++) {
            \App\Test::create([
                'title'   => 'Title '.$i
            ]);
        }
    }
}
