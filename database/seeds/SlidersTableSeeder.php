<?php
use App\Slider;
use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');
    
        Slider::create([
            'title' => 'Filtros e Válvulas',
            'description' => 'Filtro e válvulas reguladoras',
            'image' => 'http://painel.unionlux.com.br/storage/images/facks/slider/filtro-valvula.png',
            'page' => 'home',
            'order' => '01',
            'active' => 1,
            'created_at' => $date
        ]);
    }
}
