<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $profile = new Profile();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();

        // Seed test admin
        $seededAdminEmail = 'admin@admin.com';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededAdminEmail,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);
            $profile->street       = $faker->streetAddress;
            $profile->postcode     = $faker->postcode;
            $profile->city         = $faker->city;
            $profile->country      = $faker->country;
            $profile->birthday =   $faker->year ;
            $profile->birthplace = $faker->city;
            $profile->fixed_number = $faker->phoneNumber;
            $profile->mobile_number = $faker->phoneNumber;
            $profile->homepage = $faker->url;
            $profile->vita = $faker->text;
            $profile->exhibition =$faker->text;
            $profile->newsletter = $faker->boolean;
            $profile->ideenstorming = $faker->boolean;
            $profile->profile_public = $faker->boolean;
            $user->profile()->save($profile);
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed test user
        $profile = new Profile();
        $user = User::where('email', '=', 'user@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => 'user@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);
            $profile->street       = $faker->streetAddress;
            $profile->postcode     = $faker->postcode;
            $profile->city         = $faker->city;
            $profile->country      = $faker->country;
            $profile->birthday =   $faker->year ;
            $profile->birthplace = $faker->city;
            $profile->fixed_number = $faker->phoneNumber;
            $profile->mobile_number = $faker->phoneNumber;
            $profile->homepage = $faker->url;
            $profile->vita = $faker->text;
            $profile->exhibition =$faker->text;
            $profile->newsletter = $faker->boolean;
            $profile->ideenstorming = $faker->boolean;
            $profile->profile_public = $faker->boolean;
            $user->profile()->save($profile);
            $user->attachRole($userRole);
            $user->save();
        }

        // Seed test users
        // $user = factory(App\Models\Profile::class, 5)->create();
        // $users = User::All();
        // foreach ($users as $user) {
        //     if (!($user->isAdmin()) && !($user->isUnverified())) {
        //         $user->attachRole($userRole);
        //     }
        // }
    }
}