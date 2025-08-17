<?php

namespace Database\Seeders;

use App\Models\Adoptee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdopteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recs = [
            [
                'name' => 'Ambar',
                'image' => '/adoptee-images/ambar1.jpg',
                'description' => 'ambar.html'
            ],
            [
                'name' => 'Balu',
                'image' => '/adoptee-images/balu1.jpg',
                'description' => "balu.html"
            ],
            [
                'name' => 'Jeko',
                'image' => '/adoptee-images/jeko1.jpg',
                'description' => "jeko.html"
            ],
            [
                'name' => 'Kya',
                'image' => '/adoptee-images/kya1.jpg',
                'description' => "kya.html"
            ],
            [
                'name' => 'Lola',
                'image' => '/adoptee-images/lola1.jpg',
                'description' => "lola.html"
            ],
            [
                'name' => 'Luisa',
                'image' => '/adoptee-images/luisa1.jpg',
                'description' => "luisa.html"
            ],
            [
                'name' => 'Maisey',
                'image' => '/adoptee-images/maisey1.jpg',
                'description' => "maisey.html"
            ],
            [
                'name' => 'Sarabi',
                'image' => '/adoptee-images/sarabi1.jpg',
                'description' => "sarabi.html"
            ],
            [
                'name' => 'Sophie',
                'image' => '/adoptee-images/sophie1.jpg',
                'description' => "sophie.html"
            ],
            [
                'name' => 'Tango',
                'image' => '/adoptee-images/tango1.jpg',
                'description' => "tango.html"
            ],
            [
                'name' => 'Tobi',
                'image' => '/adoptee-images/tobi1.jpg',
                'description' => "tobi.html"
            ]
        ];

        foreach ($recs as $rec) {
            Adoptee::create($rec);
        }
    }
}
