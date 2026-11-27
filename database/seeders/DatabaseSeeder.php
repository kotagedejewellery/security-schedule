<?php
namespace Database\Seeders;
use App\Models\SecurityOfficer; use App\Models\User; use Illuminate\Database\Seeder; use Illuminate\Support\Facades\Hash; use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder { public function run():void { User::where('email','admin@example.test')->update(['is_admin'=>false,'password'=>Hash::make(Str::random(64))]); if(env('ADMIN_EMAIL')&&env('ADMIN_PASSWORD'))User::updateOrCreate(['email'=>env('ADMIN_EMAIL')],['name'=>'Admin Jadwal','password'=>Hash::make(env('ADMIN_PASSWORD')),'is_admin'=>true]); foreach([['Mustangin','PLG'],['Fikri','HJZ'],['Bayu','BDG'],['Saiful','SMG']] as [$n,$l]) SecurityOfficer::firstOrCreate(['name'=>$n],['base_location'=>$l]); } }
