<?php

namespace Database\Factories;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{

    protected $model = Products::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nameFirst = [
            'Bio',
            'Ízletes',
            'Paleo',
            'Laktató',
            'Zamatos',
            'Házias',
        ];
        $nameSecond = [
            'Hartai kolbász',
            'Hartai csípős kolbász',
            'Hartai diósonka füstölt-nyers',
            'Hartai törpesonka',
            'Hartai szalámi',
            'Summared nyári-őszi alma',
            'Gala Must nyári-őszi alma',
            'Earligold nyári-őszi alma',
            'Imperiál Gála nyári-őszi alma',
            'Pinova téli alma',
            'Granny Smith téli alma',
            'Topáz téli alma',
            'Mutsu téli alma',
            'Golden Reinders téli alma',
            'Braeburn téli alma',
            'Idared téli alma',
            'Borecet Tokaji Furmintból',
            'Tokaji Borecet Tokaji Furmintból',
            'Borecet Tokaji Muskotályból',
            'Tokaji Borecet Tokaji Muskotályból',
            'Balzsamecet',
            'Tokaji Balzsamecet',
            'Bió dió',
            'Madársaláta',
            'Rucola',
            'Verona mix',
            'Bébi spenót',
            'Szeletelt jégsaláta',
            'Római saláta',
            'Sárgarépa csík',
            'Szeletelt vöröskáposzta'
            ];
        $nameFirstRand = array_rand($nameFirst);
        $nameSecondRand = array_rand($nameSecond);
        
        $isAviable = (bool) mt_rand(0, 1);

        if($isAviable === true){
            $stock = mt_rand(1, 100);
        }else{
            $stock = 0;
        }

        $price = mt_rand(100, 10000);
        $sale_price = $price*0.8;

        $width = 640;
        $height = 480;

        
            $baseUrl = 'https://picsum.photos/';
            $url = '';
            $url .= 'id/' . rand(1, 1000) . '/';
            $url .= "$width/$height/";
        
           
            $url .= str_contains($url, '?') ? '&' : '?';
            $url .= 'random=' . rand(1, 1000);

        
        return [
            'name' => $nameFirst[$nameFirstRand].' '.$nameSecond[$nameSecondRand],
            'description' => $this->faker->text,
            'price' => $price,
            'sale_price' => $sale_price,
            'stock' => $stock,
            'avaible' => $isAviable,
            'image' => $baseUrl . $url
        ];
    }
}

