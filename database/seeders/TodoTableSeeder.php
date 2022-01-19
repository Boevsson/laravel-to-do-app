<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'description' => 'test todo',
            'state'       => 'Todo',
            'view_count'  => 1,
            'project_id'  => 1,
            'user_id'     => 1
        ]);
    }
}