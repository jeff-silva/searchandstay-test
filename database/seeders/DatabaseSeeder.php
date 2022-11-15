<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::firstOrNew(['id' => 1], [
            'name' => 'Root User',
            'email' => 'root@grr.la',
            'password' => \Hash::make('root'),
        ]);

        $user->save();
    }
}
