<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FriendList;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Michael Scott',
            'email' => 'michael@gmail.com',
            'password' => Hash::make('Delapan8'),
            'birth_date' => new Carbon('2000-11-11'),
            'gender' => 'Pria'
        ]);

        User::create([
            'name' => 'Jim Halpert',
            'email' => 'jim@gmail.com',
            'password' => Hash::make('Delapan8'),
            'birth_date' => new Carbon('2000-11-11'),
            'gender' => 'Pria'
        ]);

        User::create([
            'name' => 'Pam Beesly',
            'email' => 'pam@gmail.com',
            'password' => Hash::make('Delapan8'),
            'birth_date' => new Carbon('2000-11-11'),
            'gender' => 'Wanita'
        ]);

        User::create([
            'name' => 'Dwight Schurte',
            'email' => 'dwight@gmail.com',
            'password' => Hash::make('Delapan8'),
            'birth_date' => new Carbon('2000-11-11'),
            'gender' => 'Pria'
        ]);

        User::create([
            'name' => 'Kevin Malone',
            'email' => 'kevin@gmail.com',
            'password' => Hash::make('Delapan8'),
            'birth_date' => new Carbon('2000-11-11'),
            'gender' => 'Pria'
        ]);

        FriendList::create([
            'user1_id' => 1,
            'user2_id' => 2
        ]);

        FriendList::create([
            'user1_id' => 2,
            'user2_id' => 1
        ]);

        FriendList::create([
            'user1_id' => 1,
            'user2_id' => 3
        ]);

        FriendList::create([
            'user1_id' => 3,
            'user2_id' => 1
        ]);

        FriendList::create([
            'user1_id' => 4,
            'user2_id' => 5
        ]);

        FriendList::create([
            'user1_id' => 5,
            'user2_id' => 4
        ]);
    }
}
