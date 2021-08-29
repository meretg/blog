<?php

use Illuminate\Database\Seeder;
// use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     // $this->call(UserSeeder::class);
    // }
  //   public function run()
  // {
  //     DB::table('products')->insert([
  //         'name' => Str::random(10),
  //
  //     ]);
  // }
  public function run()
{
    DB::table('categories')->insert([
        'name' => Str::random(10),

    ]);
    
}

}
