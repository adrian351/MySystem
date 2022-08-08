<?php
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoTieneSustitutosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $productos = Producto::with('sustitutos')->get();
        $hastaC = count($productos) - 1;
        $reverso = count($productos);
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
            $sustituto = Producto::where('id', $reverso)->first();
            $productos[$contador2]->sustitutos()->attach($sustituto->id);
            $reverso -= 1;
        }
    }
}