<?php

use Illuminate\Database\Seeder;
use App\Entities\Models\Notification;
use App\Entities\Models\RelatedsApp;
use App\Entities\Models\AdsConfig;
use App\Entities\Models\Role;
use App\Entities\Models\User;
use App\Entities\Models\App;

class MaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {

            DB::table('maan_roles')->insert([
                'name' => $faker->name,
                'created_at' => $faker->unixTime($max = 'now'),
                'updated_at' => $faker->unixTime($max = 'now'),
            ]);

            $roleIds = Role::all()->pluck('id')->toArray();

            DB::table('maan_users')->insert([
                'appota_id' => random_int(100000,999999),
                'role_id' => $faker->randomElement($roleIds),
                'google_id' => \Hash::make($faker->username),
                'facebook_id' => \Hash::make($faker->username),
                'email' => $faker->safeEmail,
                'password' => $faker->password,
                'fullname' => $faker->name,
                'avatar' => $faker->imageUrl($width = 1000, $height = 1000),
                'gender' => rand(1, 4),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'last_activity' => $faker->slug,
                'access_token' => $faker->sha256,
                'refresh_token' => $faker->sha256,
                'remember_token' => $faker->sha256,
                'expired_at' => $faker->unixTime($max = 'now'),
                'created_at' => $faker->unixTime($max = 'now'),
                'updated_at' => $faker->unixTime($max = 'now'),
            ]);

            $userIds = User::all()->pluck('id')->toArray();

            DB::table('maan_apps')->insert([
                'name' => $faker->name,
                'platform' => $faker->slug,
                'version' => random_int(0, 9),
                'build' => random_int(0, 9),
                'api_key' => $faker->sha256,
                'secret_key' => $faker->sha256,
                'bundle_id' => random_int(1, 999),
                'user_id' => $faker->randomElement($userIds),
                'created_at' => $faker->unixTime($max = 'now'),
                'updated_at' => $faker->unixTime($max = 'now'),
            ]);

            $appIds = App::all()->pluck('id')->toArray();

            DB::table('maan_notifications')->insert([
                'title' => $faker->name,
                'image' => $faker->imageUrl($width = 1000, $height = 1000),
                'url' => $faker->imageUrl($width = 1000, $height = 1000),
                'user_id' => $faker->randomElement($userIds),
                'app_id' => $faker->randomElement($appIds),
                'created_at' => $faker->unixTime($max = 'now'),
                'updated_at' => $faker->unixTime($max = 'now'),
            ]);

            DB::table('maan_ads_config')->insert([
                'app_id' => $faker->randomElement($appIds),
                'type' => $faker->name,
                'banner' => $faker->imageUrl($width = 1000, $height = 1000),
                'interstitial' => $faker->name,
                'native' => $faker->name,
                'created_at' => $faker->unixTime($max = 'now'),
                'updated_at' => $faker->unixTime($max = 'now'),
            ]);

            DB::table('maan_relateds_app')->insert([
                'app_id' => $faker->randomElement($appIds),
                'title' => $faker->name,
                'image' => $faker->imageUrl($width = 1000, $height = 1000),
                'url' => $faker->imageUrl($width = 1000, $height = 1000),
                'url_schema' => $faker->imageUrl($width = 1000, $height = 1000),
                'created_at' => $faker->unixTime($max = 'now'),
                'updated_at' => $faker->unixTime($max = 'now'),
            ]);

            DB::table('maan_iaps')->insert([
                'type' => random_int(0, 10000),
                'product_id' => random_int(1,10000),
                'created_at' => $faker->unixTime($max = 'now'),
                'updated_at' => $faker->unixTime($max = 'now'),
            ]);

        }

        DB::table('maan_users')->insert([
            'appota_id' => random_int(100000,999999),
            'role_id' => 1,
            'google_id' => \Hash::make('akkerise'),
            'facebook_id' => \Hash::make('akkerise'),
            'password' => \Illuminate\Support\Facades\Hash::make('akkerise'),
            'email' => 'akkerise@gmail.com',
            'fullname' => 'akke',
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'avatar' => $faker->imageUrl($width = 1000, $height = 1000),
            'gender' => rand(1, 4),
            'last_activity' => $faker->slug,
            'access_token' => $faker->sha256,
            'refresh_token' => $faker->sha256,
            'remember_token' => $faker->sha256,
            'expired_at' => $faker->unixTime($max = 'now'),
            'created_at' => $faker->unixTime($max = 'now'),
            'updated_at' => $faker->unixTime($max = 'now'),
        ]);

        DB::table('maan_users')->insert([
            'appota_id' => random_int(100000,999999),
            'role_id' => 1,
            'google_id' => \Hash::make('thanhna'),
            'facebook_id' => \Hash::make('thanhna'),
            'password' => \Illuminate\Support\Facades\Hash::make('thanhna'),
            'email' => 'thanhna@appota.com',
            'fullname' => 'thanhna',
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'avatar' => $faker->imageUrl($width = 1000, $height = 1000),
            'gender' => rand(1, 4),
            'last_activity' => $faker->slug,
            'access_token' => $faker->sha256,
            'refresh_token' => $faker->sha256,
            'remember_token' => $faker->sha256,
            'expired_at' => $faker->unixTime($max = 'now'),
            'created_at' => $faker->unixTime($max = 'now'),
            'updated_at' => $faker->unixTime($max = 'now'),
        ]);

    }
}
