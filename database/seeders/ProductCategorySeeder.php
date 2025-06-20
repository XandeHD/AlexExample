<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProductCategory::insert([[
                'code' => 'cosmetics',
                'name' => 'Cosmetic Products',
                'description' => 'Creams, shampoos, lotions, and other personal care products tested for safety, stability, and microbial contamination.',
            ],[
                'code' => 'pharmaceuticals',
                'name' => 'Pharmaceutical Products',
                'description' => 'Medicines, ointments, and supplements tested for active ingredients, purity, and compliance with health regulations.',
            ],[
                'code' => 'food',
                'name' => 'Food Products',
                'description' => 'Processed foods, dairy, meats, and ready-to-eat items tested for nutritional content, contaminants, and shelf life.',
            ],[
                'code' => 'hygiene',
                'name' => 'Cleaning and Hygiene Products',
                'description' => 'Detergents, disinfectants, and soaps tested for chemical composition and effectiveness against microbes.',
            ],[
                'code' => 'rawmaterials',
                'name' => 'Raw Materials',
                'description' => 'Natural and synthetic ingredients used in manufacturing, tested for purity and consistency.',
            ],[
                'code' => 'environmental',
                'name' => 'Environmental Samples',
                'description' => 'Water, soil, and air samples tested for pollution, toxins, and compliance with environmental regulations.',
            ],[
                'code' => 'biotech',
                'name' => 'Biotechnological Products',
                'description' => 'Microbial cultures, enzymes, and bio-based substances used in industrial and scientific applications.',
            ],[
                'code' => 'chemicals',
                'name' => 'Chemical Industrial Products',
                'description' => 'Solvents, resins, and industrial chemicals tested for safety, composition, and regulatory compliance.',
            ],
        ]);

    }
}
