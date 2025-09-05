<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   */
  public function run(): void {
    User::create([
      'name'     => "Admin",
      'email'    => 'admin@example.com',
      'password' => Hash::make('password'),
    ]);

    Department::factory()->count(10)->create();
    Student::factory()->count(3)->create();
  }
}
