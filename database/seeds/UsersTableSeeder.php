<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\PersonalInformation;
use App\Address;
use App\UserRole;
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

    for($i = 0; $i < 900; $i++) {

    	 $User= new User();
        $User->name=$faker->name;
        $User->email=$faker->email;
        $User->password=Hash::make('password');
        $User->save();
        
 		$UserRole= new UserRole();
        $UserRole->role_id='2';
        $UserRole->user_id=$User->id;
        $UserRole->save();

		$Profile= new PersonalInformation();
        $Profile->user_id=$User->id;
		$Profile->avatar="";

		$first_name=$faker->firstNameMale;
		$middle_name=$faker->firstNameFemale;
		$lastName=$faker->lastName;

		$Profile->full_name=$first_name." ".$middle_name." ".$lastName;
		$Profile->first_name=$first_name;
		$Profile->middle_name_1=$middle_name;
		$Profile->last_name=$lastName;

		$Profile->phone_number=$faker->phoneNumber;
		$Profile->password_recovery_id_one='1';
		$Profile->password_recovery_ans_one=$faker->name;
		$Profile->password_recovery_id_two='2';
		$Profile->password_recovery_ans_two=$faker->name;
		$Profile->save();

		$Address= new Address();
        $Address->user_id=$User->id;
        $Address->formatted_address=$faker->address;
        $Address->building_number=$faker->buildingNumber;
        $Address->street_name=$faker->streetAddress;
        $Address->apt_suite_num=$faker->stateAbbr;
        $Address->neigborhood=$faker->citySuffix;
        $Address->municipality=$faker->state;
        $Address->city=$faker->city;
        $Address->region=$faker->country;
        $Address->w3wAddress=$faker->streetAddress;
        $Address->compound_code=$faker->buildingNumber;
        $Address->plus_code=$faker->buildingNumber;
        $Address->latitude=$faker->latitude(-90,90);
        $Address->longitude=$faker->longitude(-180,180);
        $Address->save();
    }
    }
}
