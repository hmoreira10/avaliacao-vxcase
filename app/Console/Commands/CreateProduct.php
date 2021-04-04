<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name} {reference?} {price?} {delivery_days?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para criar produto, nome obrigatorio. Referencia, preco e dias para entrega opcionais';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $controller = app()->make('App\Http\Controllers\ProductController');
        return app()->call([$controller, 'store'], [
            'request' => new \Illuminate\Http\Request([
                'name' => $this->argument('name'),
                'reference' => $this->argument('reference') ?? 'VX-' . rand(10000, 99999),
                'price' => $this->argument('price') ?? '120.00',
                'delivery_days' => $this->argument('delivery_days') ?? 22,
            ])
        ]);
    }
}
