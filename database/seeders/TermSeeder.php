<?php

namespace Database\Seeders;

use Hash, Str;
use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Term::create(
            [
                'content' => 'test consumer'
            ]
        );
        Term::create(
            [
                'content' => 'test seller'
            ]
        );
    }
}
