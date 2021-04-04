<?php

use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sales = factory(App\Models\Sale::class, 30)
            ->create()
            ->each(function ($sale) {
                $sale->products()->attach(
                    [
                        1 => ['price' => 100, 'quantity' => 1],
                        2 => ['price' => 200, 'quantity' => 2],
                        4 => ['price' => 249.99, 'quantity' => 3],
                    ]
                );
            });
    }
}
