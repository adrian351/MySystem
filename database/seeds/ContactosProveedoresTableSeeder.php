<?php

use Illuminate\Database\Seeder;

class ContactosProveedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\ContactoProveedor::class, 1000)->create(); // min
        // factory(App\Models\ContactoProveedor::class, 15000)->create(); // max
    }
}
