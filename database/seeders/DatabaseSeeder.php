<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $user=new User();
        // $user->name='Pham Van Long';
        // $user->username='Pham Van Long';
        // $user->email='phamlong123np@gmail.com';
        // $user->password=Hash::make('12345678');
        // $user->save();
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        // $admin=new Admin();
        // $admin->name='Pham Van Long';
        // $admin->email='phamlong123np@gmail.com';
        // $admin->password=Hash::make('12345678');
        // $admin->save();

    }
}
