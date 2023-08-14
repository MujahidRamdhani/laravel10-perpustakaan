<?php

namespace Database\Seeders;

use App\Models\Role;
use Faker\Guesser\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();
        
        $data = [
            'admin', 'client'
        ];
        
        foreach ($data as $value){
            Role::insert([
                'name' => $value
            ]);   
        }
    }
}
