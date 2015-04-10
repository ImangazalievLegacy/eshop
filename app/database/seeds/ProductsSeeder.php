<?php

class ProductsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();

		Product::truncate();

		$minCategoryId = Category::take(1)->get()->first()->id;
		$maxCategoryId = Category::orderBy('id', 'desc')->take(1)->get()->first()->id;

		// $currencies = array('RUB', 'EUR', 'JPY');

		// $currencyKey = array_rand($currencies);
		// $currency = $currencies[$currencyKey];

		$currency = 'RUB';

		for ($i=0; $i < 15; $i++)
		{ 

			Product::create([
				'title'          => $faker->sentence(3),
				'description'    => $faker->paragraph(20),

				'category_id'    => mt_rand($minCategoryId, $maxCategoryId),
				'url'            => $faker->word,

				'price'          => mt_rand(100, 30000),
				'old_price'      => mt_rand(30000, 50000),

				'article_number' => $faker->ean13(),
				'currency'       => $currency
			]);

		}
	}

}
