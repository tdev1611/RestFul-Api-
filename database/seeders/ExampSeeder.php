<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Examp;
class ExampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Examp::factory(50)->create();
    }
}
