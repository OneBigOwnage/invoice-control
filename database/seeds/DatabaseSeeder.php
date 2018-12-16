<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->niek();
    }

    public function niek()
    {
        factory(User::class)->create([
            'name'              => 'Niek'                               ,
            'email'             => 'development.niekvandenbos@gmail.com',
            'email_verified_at' => Carbon::now()->toDateTimeString()    ,
            'password'          => Hash::make('niekniek')               ,
            'name'              => 'Niek'                               ,
        ]);
    }
}
