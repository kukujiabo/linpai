<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
    //$this->call('CountriesTableSeeder');
    //$this->call('ProvincesTableSeeder');
    //$this->call('CitiesTableSeeder');
    //$this->call('DistrictsTableSeeder');
    //$this->call('RoadsTableSeeder');
		//$this->call('AttributesTableSeeder');
		//$this->call('GoodsTableSeeder');
		//$this->call('GoodsAttributesTableSeeder');
		//$this->call('ReceiverInfosTableSeeder');
    //$this->call('BounsTableSeeder');
    //$this->call('BankTableSeeder');
    $this->call('AdminsTableSeeder');
	}

}
